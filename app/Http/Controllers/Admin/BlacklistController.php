<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class BlacklistController extends Controller
{
    private $storageKey = 'blacklisted_countries';
    private $perPage = 10;
  
    public function index(Request $request)
    {
        $pageTitle = 'Blacklist Countries';
        $countries = $this->getCountriesFromSession();
        $emptyMessage = 'No countries blacklisted yet.';
    
        // Convert array to collection
        $countryCollection = collect($countries);
    
        // Define pagination parameters
        $perPage = 10; // Number of items per page
        $page = $request->get('page', 1); // Get the current page or default to 1
        $pagedData = $countryCollection->slice(($page - 1) * $perPage, $perPage)->values();
    
        // Create LengthAwarePaginator instance
        $pagination = new LengthAwarePaginator($pagedData, $countryCollection->count(), $perPage, $page, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
    
        $countriesForCurrentPage = $pagedData;
    
        return view('admin.accounttype.blockedCountries.index', compact('countriesForCurrentPage', 'emptyMessage', 'pageTitle', 'pagination'));
    }
    

    public function create()
    {
        $pageTitle = 'Add Countries to Blacklist';
        $availableCountries = $this->getAvailableCountries(); // Fetch available countries
        return view('admin.accounttype.blockedCountries.create', compact('availableCountries','pageTitle'));
    }

    public function store(Request $request)
    {
        $countryName = $request->input('country');

        // Check if country is already in the blacklist
        $countries = $this->getCountriesFromSession();

        if (in_array($countryName, array_column($countries, 'name'))) {

            $notify[] = ['error','Country is already blacklisted'];
            return redirect()->route('admin.blacklist.index')->withNotify($notify);

        }

        // Create new country entry
        $country = [
            'id' => uniqid(),
            'name' => $countryName,
        ];

        // Add the new country to the session
        $countries[] = $country;
        $this->saveCountriesToSession($countries);
        $notify[] = ['success','Country added to blacklist'];

        return redirect()->route('admin.blacklist.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $countries = $this->getCountriesFromSession();

        // Filter out the country to be removed
        $countries = array_filter($countries, fn($country) => $country['id'] !== $id);

        // Save updated countries back to session
        $this->saveCountriesToSession($countries);

        $notify[] = ['success','Country removed from blacklist'];

        return redirect()->route('admin.blacklist.index')->withNotify($notify);
    }

    private function getCountriesFromSession()
    {
        return session($this->storageKey, []);
    }

    private function saveCountriesToSession(array $countries)
    {
        session([$this->storageKey => $countries]);
    }

    private function getAvailableCountries()
    {
        return [
            ['id' => 1, 'name' => 'Afghanistan'],
            ['id' => 2, 'name' => 'Albania'],
            ['id' => 3, 'name' => 'Algeria'],
            ['id' => 4, 'name' => 'Andorra'],
            ['id' => 5, 'name' => 'Angola'],
            ['id' => 6, 'name' => 'Antigua and Barbuda'],
            ['id' => 7, 'name' => 'Argentina'],
            ['id' => 8, 'name' => 'Armenia'],
            ['id' => 9, 'name' => 'Australia'],
            ['id' => 10, 'name' => 'Austria'],
            ['id' => 11, 'name' => 'Azerbaijan'],
            ['id' => 12, 'name' => 'Bahamas'],
            ['id' => 13, 'name' => 'Bahrain'],
            ['id' => 14, 'name' => 'Bangladesh'],
            ['id' => 15, 'name' => 'Barbados'],
            ['id' => 16, 'name' => 'Belarus'],
            ['id' => 17, 'name' => 'Belgium'],
            ['id' => 18, 'name' => 'Belize'],
            ['id' => 19, 'name' => 'Benin'],
            ['id' => 20, 'name' => 'Bhutan'],
            ['id' => 21, 'name' => 'Bolivia'],
            ['id' => 22, 'name' => 'Bosnia and Herzegovina'],
            ['id' => 23, 'name' => 'Botswana'],
            ['id' => 24, 'name' => 'Brazil'],
            ['id' => 25, 'name' => 'Brunei'],
            ['id' => 26, 'name' => 'Bulgaria'],
            ['id' => 27, 'name' => 'Burkina Faso'],
            ['id' => 28, 'name' => 'Burundi'],
            ['id' => 29, 'name' => 'Cabo Verde'],
            ['id' => 30, 'name' => 'Cambodia'],
            ['id' => 31, 'name' => 'Cameroon'],
            ['id' => 32, 'name' => 'Canada'],
            ['id' => 33, 'name' => 'Central African Republic'],
            ['id' => 34, 'name' => 'Chad'],
            ['id' => 35, 'name' => 'Chile'],
            ['id' => 36, 'name' => 'China'],
            ['id' => 37, 'name' => 'Colombia'],
            ['id' => 38, 'name' => 'Comoros'],
            ['id' => 39, 'name' => 'Congo, Democratic Republic of the'],
            ['id' => 40, 'name' => 'Congo, Republic of the'],
            ['id' => 41, 'name' => 'Costa Rica'],
            ['id' => 42, 'name' => 'Croatia'],
            ['id' => 43, 'name' => 'Cuba'],
            ['id' => 44, 'name' => 'Cyprus'],
            ['id' => 45, 'name' => 'Czech Republic'],
            ['id' => 46, 'name' => 'Denmark'],
            ['id' => 47, 'name' => 'Djibouti'],
            ['id' => 48, 'name' => 'Dominica'],
            ['id' => 49, 'name' => 'Dominican Republic'],
            ['id' => 50, 'name' => 'Ecuador'],
            ['id' => 51, 'name' => 'Egypt'],
            ['id' => 52, 'name' => 'El Salvador'],
            ['id' => 53, 'name' => 'Equatorial Guinea'],
            ['id' => 54, 'name' => 'Eritrea'],
            ['id' => 55, 'name' => 'Estonia'],
            ['id' => 56, 'name' => 'Eswatini'],
            ['id' => 57, 'name' => 'Ethiopia'],
            ['id' => 58, 'name' => 'Fiji'],
            ['id' => 59, 'name' => 'Finland'],
            ['id' => 60, 'name' => 'France'],
            ['id' => 61, 'name' => 'Gabon'],
            ['id' => 62, 'name' => 'Gambia'],
            ['id' => 63, 'name' => 'Georgia'],
            ['id' => 64, 'name' => 'Germany'],
            ['id' => 65, 'name' => 'Ghana'],
            ['id' => 66, 'name' => 'Greece'],
            ['id' => 67, 'name' => 'Grenada'],
            ['id' => 68, 'name' => 'Guatemala'],
            ['id' => 69, 'name' => 'Guinea'],
            ['id' => 70, 'name' => 'Guinea-Bissau'],
            ['id' => 71, 'name' => 'Guyana'],
            ['id' => 72, 'name' => 'Haiti'],
            ['id' => 73, 'name' => 'Honduras'],
            ['id' => 74, 'name' => 'Hungary'],
            ['id' => 75, 'name' => 'Iceland'],
            ['id' => 76, 'name' => 'India'],
            ['id' => 77, 'name' => 'Indonesia'],
            ['id' => 78, 'name' => 'Iran'],
            ['id' => 79, 'name' => 'Iraq'],
            ['id' => 80, 'name' => 'Ireland'],
            ['id' => 81, 'name' => 'Israel'],
            ['id' => 82, 'name' => 'Italy'],
            ['id' => 83, 'name' => 'Jamaica'],
            ['id' => 84, 'name' => 'Japan'],
            ['id' => 85, 'name' => 'Jordan'],
            ['id' => 86, 'name' => 'Kazakhstan'],
            ['id' => 87, 'name' => 'Kenya'],
            ['id' => 88, 'name' => 'Kiribati'],
            ['id' => 89, 'name' => 'Korea, North'],
            ['id' => 90, 'name' => 'Korea, South'],
            ['id' => 91, 'name' => 'Kuwait'],
            ['id' => 92, 'name' => 'Kyrgyzstan'],
            ['id' => 93, 'name' => 'Laos'],
            ['id' => 94, 'name' => 'Latvia'],
            ['id' => 95, 'name' => 'Lebanon'],
            ['id' => 96, 'name' => 'Lesotho'],
            ['id' => 97, 'name' => 'Liberia'],
            ['id' => 98, 'name' => 'Libya'],
            ['id' => 99, 'name' => 'Liechtenstein'],
            ['id' => 100, 'name' => 'Lithuania'],
            ['id' => 101, 'name' => 'Luxembourg'],
            ['id' => 102, 'name' => 'Madagascar'],
            ['id' => 103, 'name' => 'Malawi'],
            ['id' => 104, 'name' => 'Malaysia'],
            ['id' => 105, 'name' => 'Maldives'],
            ['id' => 106, 'name' => 'Mali'],
            ['id' => 107, 'name' => 'Malta'],
            ['id' => 108, 'name' => 'Marshall Islands'],
            ['id' => 109, 'name' => 'Mauritania'],
            ['id' => 110, 'name' => 'Mauritius'],
            ['id' => 111, 'name' => 'Mexico'],
            ['id' => 112, 'name' => 'Micronesia'],
            ['id' => 113, 'name' => 'Moldova'],
            ['id' => 114, 'name' => 'Monaco'],
            ['id' => 115, 'name' => 'Mongolia'],
            ['id' => 116, 'name' => 'Montenegro'],
            ['id' => 117, 'name' => 'Morocco'],
            ['id' => 118, 'name' => 'Mozambique'],
            ['id' => 119, 'name' => 'Myanmar'],
            ['id' => 120, 'name' => 'Namibia'],
            ['id' => 121, 'name' => 'Nauru'],
            ['id' => 122, 'name' => 'Nepal'],
            ['id' => 123, 'name' => 'Netherlands'],
            ['id' => 124, 'name' => 'New Zealand'],
            ['id' => 125, 'name' => 'Nicaragua'],
            ['id' => 126, 'name' => 'Niger'],
            ['id' => 127, 'name' => 'Nigeria'],
            ['id' => 128, 'name' => 'North Macedonia'],
            ['id' => 129, 'name' => 'Norway'],
            ['id' => 130, 'name' => 'Oman'],
            ['id' => 131, 'name' => 'Pakistan'],
            ['id' => 132, 'name' => 'Palau'],
            ['id' => 133, 'name' => 'Palestine'],
            ['id' => 134, 'name' => 'Panama'],
            ['id' => 135, 'name' => 'Papua New Guinea'],
            ['id' => 136, 'name' => 'Paraguay'],
            ['id' => 137, 'name' => 'Peru'],
            ['id' => 138, 'name' => 'Philippines'],
            ['id' => 139, 'name' => 'Poland'],
            ['id' => 140, 'name' => 'Portugal'],
            ['id' => 141, 'name' => 'Qatar'],
            ['id' => 142, 'name' => 'Romania'],
            ['id' => 143, 'name' => 'Russia'],
            ['id' => 144, 'name' => 'Rwanda'],
            ['id' => 145, 'name' => 'Saint Kitts and Nevis'],
            ['id' => 146, 'name' => 'Saint Lucia'],
            ['id' => 147, 'name' => 'Saint Vincent and the Grenadines'],
            ['id' => 148, 'name' => 'Samoa'],
            ['id' => 149, 'name' => 'San Marino'],
            ['id' => 150, 'name' => 'Sao Tome and Principe'],
            ['id' => 151, 'name' => 'Saudi Arabia'],
            ['id' => 152, 'name' => 'Senegal'],
            ['id' => 153, 'name' => 'Serbia'],
            ['id' => 154, 'name' => 'Seychelles'],
            ['id' => 155, 'name' => 'Sierra Leone'],
            ['id' => 156, 'name' => 'Singapore'],
            ['id' => 157, 'name' => 'Slovakia'],
            ['id' => 158, 'name' => 'Slovenia'],
            ['id' => 159, 'name' => 'Solomon Islands'],
            ['id' => 160, 'name' => 'Somalia'],
            ['id' => 161, 'name' => 'South Africa'],
            ['id' => 162, 'name' => 'South Sudan'],
            ['id' => 163, 'name' => 'Spain'],
            ['id' => 164, 'name' => 'Sri Lanka'],
            ['id' => 165, 'name' => 'Sudan'],
            ['id' => 166, 'name' => 'Suriname'],
            ['id' => 167, 'name' => 'Sweden'],
            ['id' => 168, 'name' => 'Switzerland'],
            ['id' => 169, 'name' => 'Syria'],
            ['id' => 170, 'name' => 'Taiwan'],
            ['id' => 171, 'name' => 'Tajikistan'],
            ['id' => 172, 'name' => 'Tanzania'],
            ['id' => 173, 'name' => 'Thailand'],
            ['id' => 174, 'name' => 'Timor-Leste'],
            ['id' => 175, 'name' => 'Togo'],
            ['id' => 176, 'name' => 'Tonga'],
            ['id' => 177, 'name' => 'Trinidad and Tobago'],
            ['id' => 178, 'name' => 'Tunisia'],
            ['id' => 179, 'name' => 'Turkey'],
            ['id' => 180, 'name' => 'Turkmenistan'],
            ['id' => 181, 'name' => 'Tuvalu'],
            ['id' => 182, 'name' => 'Uganda'],
            ['id' => 183, 'name' => 'Ukraine'],
            ['id' => 184, 'name' => 'United Arab Emirates'],
            ['id' => 185, 'name' => 'United Kingdom'],
            ['id' => 186, 'name' => 'United States'],
            ['id' => 187, 'name' => 'Uruguay'],
            ['id' => 188, 'name' => 'Uzbekistan'],
            ['id' => 189, 'name' => 'Vanuatu'],
            ['id' => 190, 'name' => 'Vatican City'],
            ['id' => 191, 'name' => 'Venezuela'],
            ['id' => 192, 'name' => 'Vietnam'],
            ['id' => 193, 'name' => 'Yemen'],
            ['id' => 194, 'name' => 'Zambia'],
            ['id' => 195, 'name' => 'Zimbabwe'],
        ];
    }

}
