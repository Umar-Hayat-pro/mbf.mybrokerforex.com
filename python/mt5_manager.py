import argparse
import logging
import sys
import json
import MT5Manager
from MT5Manager import MTUser, MTDeal

# Configuration
DEFAULT_SERVER = r"188.240.63.163:443"
SERVER_LOGIN = 10007
SERVER_PASSWORD = "TfTe*wA1"
DEFAULT_GROUP = "demo\\MBFX\\PREMIUM_200_USD_B"
LEVERAGE_OPTIONS = [100, 200, 300, 400, 500]
INITIAL_BALANCE = 100.0

# Configure logging
logging.basicConfig(
    format='%(asctime)s %(levelname)s:%(message)s',
    level=logging.INFO
)

def connect_manager():
    """Connect to MT5 server"""
    manager = MT5Manager.ManagerAPI()
    logging.info("Connecting to MT5 server...")
    if not manager.Connect(DEFAULT_SERVER, SERVER_LOGIN, SERVER_PASSWORD, 0):
        error = MT5Manager.LastError()
        raise ConnectionError(f"Connection failed: Code {error[0]} ({error[1].name}) - {error[2]}")
    logging.info("Connection successful")
    return manager

def create_account(args):
    """Create MT5 account with full parameter handling"""
    try:
        # Input validation
        if not all([args.first_name, args.last_name, args.password]):
            raise ValueError("Missing required parameters")
        if args.leverage not in LEVERAGE_OPTIONS:
            raise ValueError(f"Invalid leverage. Available options: {LEVERAGE_OPTIONS}")

        manager = connect_manager()
        
        # Create user object
        user             = MTUser(manager)
        user.Group       = args.group  # Use dynamic group from arguments
        user.Leverage    = args.leverage
        user.FirstName   = args.first_name
        user.LastName    = args.last_name
        user.Country     = args.country
        user.City        = args.city
        user.State       = args.state
        user.Address     = args.address
        user.ZIPCode     = str(args.zipcode)
        user.Phone       = args.phone  # Assume pre-validated format
        user.Company     = args.company or "Individual"
        user.Status      = "RE"

        # Email handling
        if hasattr(user, 'EMail'):
            user.EMail   = args.email
        else:
            user.Comment = f"Email: {args.email}"

        # Account creation
        if not manager.UserAdd(user, args.password, args.password):
            error = MT5Manager.LastError()
            raise RuntimeError(f"Creation failed: {error[0]} ({error[1].name}) - {error[2]}")

        generated_login = user.Login

        # Initial deposit
        if args.initial_balance > 0:
            if not manager.DealerBalance(generated_login, args.initial_balance, 
                                       MTDeal.EnDealAction.DEAL_BALANCE, "Initial deposit"):
                logging.warning("Balance deposit failed")

        # JSON output
        print(json.dumps({
            "Login": generated_login,
            "MasterPassword": args.password,
            "Email": args.email
        }))

        return generated_login

    except Exception as e:
        logging.error(f"Error: {str(e)}")
        return None
    finally:
        if 'manager' in locals():
            manager.Disconnect()





def update_account(args):
    """Update account password/leverage"""
    try:
        manager = connect_manager()
        login = int(args.login)

        # Password update
        if args.new_password:
            if len(args.new_password) < 6:
                raise ValueError("Password must be at least 6 characters")

            password_type = (MTUser.EnUsersPasswords.USER_PASS_INVESTOR
                            if args.password_type == 'investor'
                            else MTUser.EnUsersPasswords.USER_PASS_MAIN)

            if not manager.UserPasswordChange(password_type, login, args.new_password):
                error = MT5Manager.LastError()
                raise RuntimeError(f"Password update failed: {error[0]} ({error[1].name}) - {error[2]}")

        # Leverage update
        if args.leverage:
            if args.leverage not in LEVERAGE_OPTIONS:
                raise ValueError(f"Invalid leverage. Available options: {LEVERAGE_OPTIONS}")

            user = manager.UserRequest(login)
            if not user:
                raise ValueError("Account not found")

           # Updated UserAdd section
            user             = MTUser(manager)
            user.Group       = args.group
            user.Leverage    = args.leverage
            user.FirstName   = args.first_name
            user.LastName    = args.last_name
            user.Country     = args.country
            user.State       = args.state
            user.City        = args.city
            user.Address     = args.address if args.address else "Not Provided"
            user.ZipCode     = str(args.zipcode)  # Ensure string type
            user.Phone       = args.phone.replace("+", "")  # Remove '+' if problematic
            user.Company     = args.company if args.company else "Individual"  # Fallback

            if not manager.UserAdd(user, args.password, args.password):
                error = MT5Manager.LastError()
                logging.error(f"MT5 Error: Code={error[0]}, Type={error[1].name}, Message={error[2]}")
                raise RuntimeError(f"Failed: {error[2]}")

        return True

    except Exception as e:
        print(f"Update failed: {str(e)}")
        return False
    finally:
        if 'manager' in locals():
            manager.Disconnect()

if __name__ == "__main__":
    parser = argparse.ArgumentParser()
    subparsers = parser.add_subparsers(dest='action', required=True)

     # Enhanced create parser
    create_parser = subparsers.add_parser('create')
    create_parser.add_argument('--first_name', required=True)
    create_parser.add_argument('--last_name', required=True)
    create_parser.add_argument('--password', required=True)
    create_parser.add_argument('--group', required=True)  # Now dynamic
    create_parser.add_argument('--leverage', type=int, choices=LEVERAGE_OPTIONS, required=True)
    create_parser.add_argument('--email', required=True)
    create_parser.add_argument('--country', required=True)
    create_parser.add_argument('--city', required=True)
    create_parser.add_argument('--state', required=True)
    create_parser.add_argument('--address', required=True)
    create_parser.add_argument('--zipcode', required=True)
    create_parser.add_argument('--phone', required=True)
    create_parser.add_argument('--company')
    create_parser.add_argument('--status')
    create_parser.add_argument('--initial_balance', type=float, default=0.0)
    create_parser.add_argument('--manager')
    create_parser.add_argument('--manager_pswd')
    create_parser.add_argument('--server_ip')

    # Update parser remains the same
    update_parser = subparsers.add_parser('update', help='Update account settings')
    update_parser.add_argument('--login', required=True, type=int, help="Account number")
    update_parser.add_argument('--password', required=True, help="Current password for verification")
    update_parser.add_argument('--new_password', help="New password")
    update_parser.add_argument('--password_type', choices=['main', 'investor'], default='main')
    update_parser.add_argument('--leverage', type=int, choices=LEVERAGE_OPTIONS, help="New leverage ratio")

    args = parser.parse_args()
    
    if args.action == 'create':
        result = create_account(args)
        exit(0 if result else 1)