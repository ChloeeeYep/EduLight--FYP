<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AuthUser extends Controller
{

    function signin(){
        return view('signin');
    }

    function signup(){
        return view('signup');
    }


    function signinPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials))
        {
            
            $user = Auth::user();

            if ($user->status != 1) {
                Auth::logout(); // Ensure the user is logged out if not active
                return redirect(route('signin'))->with("error", "Your Account is Inactive. Please Contact Admin.");
            }

            if ($user->user_type === 'A') {
                return redirect()->intended(route('adminhome'));
            } elseif ($user->user_type === 'P') {
                return redirect()->intended(route('home'));
            } elseif ($user->user_type === 'U'){
                return redirect()->intended(route('unihome'));
            }
        }

        return redirect(route('signin'))->with("error","Login Details Are Not Valid");
    }

    function signupPost(Request $request){
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' =>'required|min:5',
            'confirm' => 'required_with:password|same:password'
        ]);

        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        
        $user = User::create($data);

        if(!$user){
            return redirect(route('signup'))->with("error","Registration Failed, Try Again");
        }
        return redirect(route('signin'))->with("Success","Login to access");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('home'));
    }



    //show user profile
    public function showProfile()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user

        // Convert the birthday to a Carbon instance if it's not already
        $birthday = Carbon::parse($user->birthday); // This line is just for safety

       // Convert the birthday to a Carbon instance if it's not already
       if ($user->birthday) {
        $birthday = Carbon::parse($user->birthday);
        $birthdayComponents = [
            'day' => $birthday->format('d'),
            'month' => $birthday->format('m'),
            'year' => $birthday->format('Y'),
        ];
    } else {
        $birthdayComponents = null; // Or ['day' => null, 'month' => null, 'year' => null];
    }

        $countries = [
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, The Democratic Republic of The',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => 'Korea, Democratic People\'s Republic of',
            'KR' => 'Korea, Republic of',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia, The Former Yugoslav Republic of',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States of',
            'MD' => 'Moldova, Republic of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and The Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and The South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania, United Republic of',
            'TH' => 'Thailand',
            'TL' => 'Timor-leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        ];
        

        return view('profile', [
            'user' => $user, 
            'birthdayComponents' => $birthdayComponents ?: ['day' => null, 'month' => null, 'year' => null],
            'countries' => $countries
        ]);
    }


    //User Update own Profile
    public function update(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'User not found.');
        }
    
        $request->validate([
            'username' => 'required|min:3|max:100',
            'name' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable',
            'birthday_day' => 'nullable|integer|between:1,31',
            'birthday_month' => 'nullable|integer|between:1,12',
            'birthday_year' => 'nullable|integer',
            'country' => 'nullable',
            'phone' => 'nullable|regex:/^\d{10,11}$/',
            'website' => 'nullable',
            'file' => 'nullable|file|mimes:pdf', 
        ]);
    
        // Check if new password is provided and confirm password matches
        if ($request->filled('new_password')) {
            if ($request->new_password !== $request->confirm_password) {
                // Redirect with a session error for confirmation password not matching
                return back()->withErrors(['confirm_password' => 'The confirmation password does not match.'])->withInput();
            }
        
            $user->password = Hash::make($request->new_password);
        }
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        if ($request->filled('birthday_day') && $request->filled('birthday_month') && $request->filled('birthday_year')) {
            $user->birthday = Carbon::createFromDate($request->birthday_year, $request->birthday_month, $request->birthday_day)->toDateString();
        } else {
            $user->birthday = null; // Set the birthday to null if not all parts are provided
        }
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');
        $user->website = $request->input('website');
        
        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($user->file) {
                Storage::delete($user->file);
            }

            $filePath = $request->file('file')->store('user_files', 'public');
            $user->file = $filePath; // Save the path to the user's record
        }
    
        // Save the user
        if ($user->save()) {
            return redirect(route('profile.show'))->with('success', 'Profile Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update profile.');
        }
    }



    //admin side

    //admin add new user
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users',
            'user_type' => 'required',
            'password' =>'required|min:5',
            'confirm' => 'required_with:password|same:password'
        ]);
        
        $input = $request->all();

        $input['password'] = Hash::make($request->password);
    
        User::create($input);

        return redirect()->route('user')->with('success','New User Added Successfully!');
    }


    //admin page show user
    function index()
    {
        if (Auth::check()) {
            $userType = Auth::user()->user_type;

            if ($userType == 'A') {
                $users = User::where('status', true)->get();
                $groupedusers = $users->groupBy('user_type');

                $userTypeNames = [
                    'A' => 'Admin',
                    'P' => 'Users',
                    'U' => 'Universities'
                ];

                $userTypeCounts = [
                    'A' => User::where('user_type', 'A')->where('status', true)->count(),
                    'P' => User::where('user_type', 'P')->where('status', true)->count(),
                    'U' => User::where('user_type', 'U')->where('status', true)->count(),
                ];

                return view('user', ['groupedusers' => $groupedusers, 'userTypeNames' => $userTypeNames ,'userTypeCounts' => $userTypeCounts]);
            }
        }

        // Redirect or show an error if not authenticated or not an admin
        return redirect('/')->with('error', 'Unauthorized access.');
    }


    //export-csv
    public function exportUsersCSV()
    {
        // Start output buffering
        ob_start();

        $users = User::select('id', 'username', 'email', 'user_type', 'name', 'bio', 'birthday', 'country', 'phone')
                    ->where('status', 1) // Make sure to include only active users or any other conditions you want
                    ->get();

        $fileName = 'users.csv';
        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function() use ($users) {
            // Clear the output buffer
            ob_clean();

            $file = fopen('php://output', 'w');
            // Add CSV headers
            fputcsv($file, ['No.','User Id', 'Username', 'Email', 'User Type', 'Full Name', 'Bio', 'Birthday', 'Country', 'Phone']);

            foreach ($users as $index => $user) {
                // Ensure the birthday is a Carbon instance
                $birthday = $user->birthday ? (new Carbon($user->birthday))->format('Y-m-d') : '';
                fputcsv($file, [
                    $index + 1,
                    $user->id,
                    $user->username,
                    $user->email,
                    $user->user_type,
                    $user->name,
                    $user->bio,
                    $birthday,
                    $user->country,
                    $user->phone
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers)->send();
    }




    //admin page show user details
    public function show(User $item)
    {
        $countries = [
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, The Democratic Republic of The',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => 'Korea, Democratic People\'s Republic of',
            'KR' => 'Korea, Republic of',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia, The Former Yugoslav Republic of',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States of',
            'MD' => 'Moldova, Republic of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and The Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and The South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania, United Republic of',
            'TH' => 'Thailand',
            'TL' => 'Timor-leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        ];

        return view('showuser', [
            'item' => $item, 
            'countries' => $countries
        ]);
    }


    //admin page show edit user
    public function editProfile(User $item)
    {
        log::info($item);
        $user = $item;

        // Convert the birthday to a Carbon instance if it's not already
        if ($user->birthday) {
            $birthday = Carbon::parse($user->birthday);
            $birthdayComponents = [
                'day' => $birthday->format('d'),
                'month' => $birthday->format('m'),
                'year' => $birthday->format('Y'),
            ];
        } else {
            $birthdayComponents = null; // Or ['day' => null, 'month' => null, 'year' => null];
        }

        $countries = [
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, The Democratic Republic of The',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => 'Korea, Democratic People\'s Republic of',
            'KR' => 'Korea, Republic of',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia, The Former Yugoslav Republic of',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States of',
            'MD' => 'Moldova, Republic of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and The Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and The South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania, United Republic of',
            'TH' => 'Thailand',
            'TL' => 'Timor-leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        ];
        

        return view('edituser', [
            'user' => $user, 
            'birthdayComponents' => $birthdayComponents ?: ['day' => null, 'month' => null, 'year' => null],
            'countries' => $countries
        ]);
    }


    //admin page update user details
    public function updateUser(Request $request, User $item)
    {
        Log::info($request->all()); // log all request data
    
        // Retrieve the actual user to update using the route model binding
        $user = $item;
    
        if (!$user) {
            return back()->with('error', 'User not found.');
        }
    
        $request->validate([
            'username' => 'required|min:3|max:100',
            'name' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable',
            'new_password' =>'nullable|min:5',
            'birthday_day' => 'nullable|integer|between:1,31',
            'birthday_month' => 'nullable|integer|between:1,12',
            'birthday_year' => 'nullable|integer',
            'country' => 'nullable',
            'phone' => 'nullable|regex:/^\d{10,11}$/',
            'website' => 'nullable',
            'file' => 'nullable|file|mimes:pdf',
        ]);
    
        // Check if new password is provided and confirm password matches
        if ($request->filled('new_password')) {
            if ($request->new_password !== $request->confirm_password) {
                return back()->withErrors(['confirm_password' => 'The confirmation password does not match.'])->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }
    
        // Assign the fields to the user model
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        if ($request->filled('birthday_day') && $request->filled('birthday_month') && $request->filled('birthday_year')) {
            $user->birthday = Carbon::createFromDate($request->birthday_year, $request->birthday_month, $request->birthday_day)->toDateString();
        } else {
            $user->birthday = null; // Set the birthday to null if not all parts are provided
        }        
        $user->country = $request->country;
        $user->phone = $request->phone;
        $user->website = $request->website;
    
        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($user->file) {
                Storage::delete($user->file);
            }
            // Store the new file and save the path
            $filePath = $request->file('file')->store('user_files', 'public');
            $user->file = $filePath; // Save the path to the user's record
        }

        // Save the user
        if ($user->save()) {
            return redirect(route('user'))->with('success', 'Profile Updated Successfully!');
        } else {
            Log::info("Failed to update the user.");
            return redirect()->back()->with('error', 'Failed to Update Profile.');
        }
    }


    //admin page delete user
    public function deleteUser($item)
    {
        $user = User::findOrFail($item);
        $user->status = 0;
        $user->save();

        return back()->with('success', 'User Has Been Deleted.');
    }


     //admin page show own profile
    public function showAdminProfile()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user

        // Convert the birthday to a Carbon instance if it's not already
        $birthday = Carbon::parse($user->birthday); // This line is just for safety

         // Convert the birthday to a Carbon instance if it's not already
         if ($user->birthday) {
            $birthday = Carbon::parse($user->birthday);
            $birthdayComponents = [
                'day' => $birthday->format('d'),
                'month' => $birthday->format('m'),
                'year' => $birthday->format('Y'),
            ];
        } else {
            $birthdayComponents = null; // Or ['day' => null, 'month' => null, 'year' => null];
        }


        $countries = [
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, The Democratic Republic of The',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => 'Korea, Democratic People\'s Republic of',
            'KR' => 'Korea, Republic of',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia, The Former Yugoslav Republic of',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States of',
            'MD' => 'Moldova, Republic of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and The Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and The South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania, United Republic of',
            'TH' => 'Thailand',
            'TL' => 'Timor-leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        ];
        
        log::info( $birthdayComponents);
        return view('adminprofile', [
            'user' => $user, 
            'birthdayComponents' => $birthdayComponents ?: ['day' => null, 'month' => null, 'year' => null],
            'countries' => $countries
        ]);
    }


    //admin page update own profile
    public function updateAdminProfile(Request $request)
    {
        Log::info($request);
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }
    
        $request->validate([
            'username' => 'required|min:3|max:100',
            'name' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable',
            'new_password' =>'nullable|min:5',
            'birthday_day' => 'nullable|integer|between:1,31',
            'birthday_month' => 'nullable|integer|between:1,12',
            'birthday_year' => 'nullable|integer',
            'country' => 'nullable',
            'phone' => 'nullable|regex:/^\d{10,11}$/',
            'website' => 'nullable',
            'file' => 'nullable|file|mimes:pdf', 
        ]);
    
        // Check if new password is provided and confirm password matches
        if ($request->filled('new_password')) {
            if ($request->new_password !== $request->confirm_password) {
                // Redirect with a session error for confirmation password not matching
                return back()->withErrors(['confirm_password' => 'The confirmation password does not match.'])->withInput();
            }
        
            $user->password = Hash::make($request->new_password);
        }
    
        // Assign the fields to the user model
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        if ($request->filled('birthday_day') && $request->filled('birthday_month') && $request->filled('birthday_year')) {
            $user->birthday = Carbon::createFromDate($request->birthday_year, $request->birthday_month, $request->birthday_day)->toDateString();
        } else {
            $user->birthday = null; // Set the birthday to null if not all parts are provided
        }
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');
        $user->website = $request->input('website');

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($user->file) {
                Storage::delete($user->file);
            }
            // Store the new file
            $filePath = $request->file('file')->store('user_files', 'public');
            $user->file = $filePath;
        }

        // Save the user
        if ($user->save()) {
            return redirect()->route('adminprofile.show')->with('success', 'Profile Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to Update Profile.');
        }
    }

    //admin page search function
    public function search(Request $request)
    {
        $searchQuery = $request->query('query', '');

        // Start the query builder
        $query = User::where('status', true);

        // If there is a search query, add the search conditions
        if (!empty($searchQuery)) {
            $query->where(function($query) use ($searchQuery) {
                $query->where('username', 'LIKE', "%{$searchQuery}%")
                    ->orWhere('name', 'LIKE', "%{$searchQuery}%");
            });
        }

        // Fetch the users based on the above criteria
        $users = $query->get();

        // Group the users by type for the count
        $groupedusers = $users->groupBy('user_type');

        // Now calculate the count based on the filtered group
        $userTypeCounts = [
            'A' => isset($groupedusers['A']) ? $groupedusers['A']->count() : 0,
            'P' => isset($groupedusers['P']) ? $groupedusers['P']->count() : 0,
            'U' => isset($groupedusers['U']) ? $groupedusers['U']->count() : 0,
        ];

        // Provide a name for each user type
        $userTypeNames = [
            'A' => 'Admins',
            'P' => 'Users',
            'U' => 'Universities'
        ];

        return view('user', [
            'users' => $users,
            'searchQuery' => $searchQuery,
            'groupedusers' => $groupedusers,
            'userTypeNames' => $userTypeNames,
            'userTypeCounts' => $userTypeCounts
        ]);
    }

    //filter user page
    public function filterUser(Request $request)
    {
        $userType = $request->query('type', null);

        $users = User::where('status', true);

        if ($userType) {
            $users = $users->where('user_type', $userType);
        }

        $users = $users->get();
        $groupedusers = $users->groupBy('user_type');

        // Group the users by type for the count
        $groupedusers = $users->groupBy('user_type');

        // Now calculate the count based on the filtered group
        $userTypeCounts = [
            'A' => isset($groupedusers['A']) ? $groupedusers['A']->count() : 0,
            'P' => isset($groupedusers['P']) ? $groupedusers['P']->count() : 0,
            'U' => isset($groupedusers['U']) ? $groupedusers['U']->count() : 0,
        ];

        // Provide a name for each user type
        $userTypeNames = [
            'A' => 'Admins',
            'P' => 'Users',
            'U' => 'Universities'
        ];

        return view('user', [
            'groupedusers' => $groupedusers,
            'filterType' => $userType,
            'userTypeNames' => $userTypeNames,
            'userTypeCounts' => $userTypeCounts // This will be useful for the UI to show what's being filtered
        ]);
    }




    //university side
    //Uni page show own profile
    public function showUniProfile()
    {
        $user = Auth::user(); // Retrieve the currently authenticated user

        // Convert the birthday to a Carbon instance if it's not already
        $birthday = Carbon::parse($user->birthday); // This line is just for safety

        // Convert the birthday to a Carbon instance if it's not already
        if ($user->birthday) {
            $birthday = Carbon::parse($user->birthday);
            $birthdayComponents = [
                'day' => $birthday->format('d'),
                'month' => $birthday->format('m'),
                'year' => $birthday->format('Y'),
            ];
        } else {
            $birthdayComponents = null; // Or ['day' => null, 'month' => null, 'year' => null];
        }


        $countries = [
            'AF' => 'Afghanistan',
            'AX' => 'Åland Islands',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'IO' => 'British Indian Ocean Territory',
            'BN' => 'Brunei Darussalam',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos (Keeling) Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo',
            'CD' => 'Congo, The Democratic Republic of The',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'CI' => 'Cote D\'ivoire',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands (Malvinas)',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and Mcdonald Islands',
            'VA' => 'Holy See (Vatican City State)',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran, Islamic Republic of',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KP' => 'Korea, Democratic People\'s Republic of',
            'KR' => 'Korea, Republic of',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Lao People\'s Democratic Republic',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libyan Arab Jamahiriya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macao',
            'MK' => 'Macedonia, The Former Yugoslav Republic of',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'MX' => 'Mexico',
            'FM' => 'Micronesia, Federated States of',
            'MD' => 'Moldova, Republic of',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territory, Occupied',
            'PA' => 'Panama',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RE' => 'Reunion',
            'RO' => 'Romania',
            'RU' => 'Russian Federation',
            'RW' => 'Rwanda',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and The Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tome and Principe',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and The South Sandwich Islands',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syrian Arab Republic',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania, United Republic of',
            'TH' => 'Thailand',
            'TL' => 'Timor-leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'UM' => 'United States Minor Outlying Islands',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VE' => 'Venezuela',
            'VN' => 'Viet Nam',
            'VG' => 'Virgin Islands, British',
            'VI' => 'Virgin Islands, U.S.',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe'
        ];
        
        return view('uniprofile', [
            'user' => $user, 
            'birthdayComponents' => $birthdayComponents ?: ['day' => null, 'month' => null, 'year' => null],
            'countries' => $countries
        ]);
    }


    //Uni page update own profile
    public function updateUniProfile(Request $request)
    {
        Log::info($request);
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }
    
        $request->validate([
            'username' => 'required|min:3|max:100',
            'name' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'bio' => 'nullable',
            'new_password' =>'nullable|min:5',
            'birthday_day' => 'nullable|integer|between:1,31',
            'birthday_month' => 'nullable|integer|between:1,12',
            'birthday_year' => 'nullable|integer',
            'country' => 'nullable',
            'phone' => 'nullable|regex:/^\d{10,11}$/',
            'website' => 'nullable',
            'file' => 'nullable|file|mimes:pdf', 
        ]);
    
        // Check if new password is provided and confirm password matches
        if ($request->filled('new_password')) {
            if ($request->new_password !== $request->confirm_password) {
                // Redirect with a session error for confirmation password not matching
                return back()->withErrors(['confirm_password' => 'The confirmation password does not match.'])->withInput();
            }
        
            $user->password = Hash::make($request->new_password);
        }
    
        // Assign the fields to the user model
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->bio = $request->input('bio');
        if ($request->filled('birthday_day') && $request->filled('birthday_month') && $request->filled('birthday_year')) {
            $user->birthday = Carbon::createFromDate($request->birthday_year, $request->birthday_month, $request->birthday_day)->toDateString();
        } else {
            $user->birthday = null; // Set the birthday to null if not all parts are provided
        }
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');
        $user->website = $request->input('website');

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($user->file) {
                Storage::delete($user->file);
            }
            // Store the new file
            $filePath = $request->file('file')->store('user_files', 'public');
            $user->file = $filePath;
        }

        // Save the user
        if ($user->save()) {
            return redirect()->route('uniprofile.show')->with('success', 'Profile Updated Successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to Update Profile.');
        }
    }
    
}
