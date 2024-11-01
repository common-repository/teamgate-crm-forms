=== Teamgate CRM Forms for WordPress ===
Contributors: Teamgate
Donate link: https://www.teamgate.com
Tags: leads forms, leads generate forms, contact forms, web forms, embedding web forms, online forms, crm forms, teamgate, crm, forms, leads, deals, contacts, companies, people, person, inbound process, sales
Requires at least: 5.0.0
Requires PHP: 7.4
Tested up to: 6.2
Stable tag: 1.6.3
License: MIT
License URI: https://www.teamgate.com/terms-of-service/

Automate generation of leads to Teamgate CRM by creating contacts, subscriptions or other kind of forms within your WordPress website. 

== Description ==

Teamgate CRM forms for WordPress allows you to connect your WordPress website with your [Teamgate](https://www.teamgate.com/?utm_source=wordpress%20plugin) account. Your website visitors will be able to fill up the forms you created. A new Lead, Contact or a new Deal will be created from data entered by the website visitor. By automating Lead generation process, you will never lose your potential customers. This way, you can focus more on working with the information sent to Teamgate CRM.

To embed your forms on your WordPress website, you need a Teamgate account. [Sign in](https://my.teamgate.com/) or [Sign up](https://www.teamgate.com/trial/?utm_source=wordpress%20plugin) for Teamgate.

Teamgate plugin is a [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) extention, so, in order to install this plugin for your WordPress website, first you need to make sure you have [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) plugin installed already. The plugin will generate a short code of form that need to be put into your WordPress page editor, in order to see the created form in your website.

**Features:**
1. Sends data from your WordPress website to Teamgate CRM.
2. Allows to select fields that will be sent to Teamgate CRM.
3. Allows to select entry type (Lead, Contact, Deal).
4. Allow to add multiple addresses, emails, phones, urls, tags to contact. For example:
```
[hidden teamgate-address-type "work"]
[select* teamgate-address-countryIso "Lithuania|LTU" "Andorra|AND" "United Arab Emirates|ARE" "Afghanistan|AFG" "Antigua and Barbuda|ATG" "Anguilla|AIA" "Albania|ALB" "Armenia|ARM" "Angola|AGO" "Antarctica|ATA" "Argentina|ARG" "American Samoa|ASM" "Austria|AUT" "Australia|AUS" "Aruba|ABW" "Ã…land Islands|ALA" "Azerbaijan|AZE" "Bosnia and Herzegovina|BIH" "Barbados|BRB" "Bangladesh|BGD" "Belgium|BEL" "Burkina Faso|BFA" "Bulgaria|BGR" "Bahrain|BHR" "Burundi|BDI" "Benin|BEN" "Saint BarthÃ©lemy|BLM" "Bermuda|BMU" "Brunei|BRN" "Bolivia|BOL" "Bonaire, Saint Eustatius, and Saba|BES" "Brazil|BRA" "Bahamas|BHS" "Bhutan|BTN" "Bouvet Island|BVT" "Botswana|BWA" "Belarus|BLR" "Belize|BLZ" "Canada|CAN" "Cocos (Keeling) Islands|CCK" "Congo (DRC)|COD" "Central African Republic|CAF" "Congo (Republic)|COG" "Switzerland|CHE" "Ivory Coast|CIV" "Cook Islands|COK" "Chile|CHL" "Cameroon|CMR" "China|CHN" "Colombia|COL" "Costa Rica|CRI" "Cuba|CUB" "Cape Verde|CPV" "CuraÃ§ao|CUW" "Christmas Island|CXR" "Cyprus|CYP" "Czech Republic|CZE" "Germany|DEU" "Djibouti|DJI" "Denmark|DNK" "Dominica|DMA" "Dominican Republic|DOM" "Algeria|DZA" "Ecuador|ECU" "Estonia|EST" "Egypt|EGY" "Western Sahara|ESH" "Eritrea|ERI" "Spain|ESP" "Ethiopia|ETH" "Finland|FIN" "Fiji|FJI" "Falkland Islands (Islas Malvinas)|FLK" "Micronesia|FSM" "Faroe Islands|FRO" "France|FRA" "Gabon|GAB" "United Kingdom|GBR" "Grenada|GRD" "Georgia|GEO" "French Guiana|GUF" "Guernsey|GGY" "Ghana|GHA" "Gibraltar|GIB" "Greenland|GRL" "Gambia|GMB" "Guinea|GIN" "Guadeloupe|GLP" "Equatorial Guinea|GNQ" "Greece|GRC" "South Georgia and the South Sandwich Islands|SGS" "Guatemala|GTM" "Guam|GUM" "Guinea-Bissau|GNB" "Guyana|GUY" "Hong Kong|HKG" "Heard Island and McDonald Islands|HMD" "Honduras|HND" "Croatia|HRV" "Haiti|HTI" "Hungary|HUN" "Indonesia|IDN" "Ireland|IRL" "Israel|ISR" "Isle of Man|IMN" "India|IND" "British Indian Ocean Territory|IOT" "Iraq|IRQ" "Iran|IRN" "Iceland|ISL" "Italy|ITA" "Jersey|JEY" "Jamaica|JAM" "Jordan|JOR" "Japan|JPN" "Kenya|KEN" "Kyrgyzstan|KGZ" "Cambodia|KHM" "Kiribati|KIR" "Comoros|COM" "Saint Kitts and Nevis|KNA" "North Korea|PRK" "South Korea|KOR" "Kuwait|KWT" "Cayman Islands|CYM" "Kazakhstan|KAZ" "Laos|LAO" "Lebanon|LBN" "Saint Lucia|LCA" "Liechtenstein|LIE" "Sri Lanka|LKA" "Liberia|LBR" "Lesotho|LSO" "Luxembourg|LUX" "Latvia|LVA" "Libya|LBY" "Morocco|MAR" "Monaco|MCO" "Moldova|MDA" "Montenegro|MNE" "Madagascar|MDG" "Marshall Islands|MHL" "Macedonia (FYROM)|MKD" "Mali|MLI" "Myanmar (Burma)|MMR" "Mongolia|MNG" "Macau|MAC" "Northern Mariana Islands|MNP" "Martinique|MTQ" "Mauritania|MRT" "Montserrat|MSR" "Malta|MLT" "Mauritius|MUS" "Maldives|MDV" "Malawi|MWI" "Mexico|MEX" "Malaysia|MYS" "Mozambique|MOZ" "Namibia|NAM" "New Caledonia|NCL" "Niger|NER" "Norfolk Island|NFK" "Nigeria|NGA" "Nicaragua|NIC" "Netherlands|NLD" "Norway|NOR" "Nepal|NPL" "Nauru|NRU" "Niue|NIU" "New Zealand|NZL" "Oman|OMN" "Panama|PAN" "Peru|PER" "French Polynesia|PYF" "Papua New Guinea|PNG" "Philippines|PHL" "Pakistan|PAK" "Poland|POL" "Saint Pierre and Miquelon|SPM" "Pitcairn Islands|PCN" "Puerto Rico|PRI" "Palestinian Territories|PSE" "Portugal|PRT" "Palau|PLW" "Paraguay|PRY" "Qatar|QAT" "RÃ©union|REU" "Romania|ROU" "Serbia|SRB" "Russia|RUS" "Rwanda|RWA" "Saudi Arabia|SAU" "Solomon Islands|SLB" "Seychelles|SYC" "Sudan|SDN" "Sweden|SWE" "Singapore|SGP" "Saint Helena|SHN" "Slovenia|SVN" "Svalbard and Jan Mayen|SJM" "Slovakia|SVK" "Sierra Leone|SLE" "San Marino|SMR" "Senegal|SEN" "Somalia|SOM" "Suriname|SUR" "SÃ£o TomÃ© and PrÃ­ncipe|STP" "El Salvador|SLV" "Sint Maarten|SXM" "Syria|SYR" "Swaziland|SWZ" "Turks and Caicos Islands|TCA" "Chad|TCD" "French Southern Territories|ATF" "Togo|TGO" "Thailand|THA" "Tajikistan|TJK" "Tokelau|TKL" "East Timor|TLS" "Turkmenistan|TKM" "Tunisia|TUN" "Tonga|TON" "Turkey|TUR" "Trinidad and Tobago|TTO" "Tuvalu|TUV" "Taiwan|TWN" "Tanzania|TZA" "Ukraine|UKR" "Uganda|UGA" "U.S. Minor Outlying Islands|UMI" "Uruguay|URY" "Uzbekistan|UZB" "Vatican City|VAT" "Saint Vincent and the Grenadines|VCT" "Venezuela|VEN" "British Virgin Islands|VGB" "U.S. Virgin Islands|VIR" "Vietnam|VNM" "Vanuatu|VUT" "Wallis and Futuna|WLF" "Samoa|WSM" "Yemen|YEM" "Mayotte|MYT" "South Africa|ZAF" "Zambia|ZMB" "Zimbabwe|ZWE" "United States|USA" "South Sudan|SSD"]
[text* teamgate-address-state class=form-control placeholder "*Province"]
[text* teamgate-address-street class=form-control placeholder "*Street, Number"]
[text* teamgate-address-city class=form-control placeholder "*City"]
[text* teamgate-address-zip class=form-control placeholder "*Postal Code"]
[hidden teamgate-address-2-type "home"]
[select* teamgate-address-2-countryIso "Lithuania|LTU" "Andorra|AND" "United Arab Emirates|ARE" "Afghanistan|AFG" "Antigua and Barbuda|ATG" "Anguilla|AIA" "Albania|ALB" "Armenia|ARM" "Angola|AGO" "Antarctica|ATA" "Argentina|ARG" "American Samoa|ASM" "Austria|AUT" "Australia|AUS" "Aruba|ABW" "Ã…land Islands|ALA" "Azerbaijan|AZE" "Bosnia and Herzegovina|BIH" "Barbados|BRB" "Bangladesh|BGD" "Belgium|BEL" "Burkina Faso|BFA" "Bulgaria|BGR" "Bahrain|BHR" "Burundi|BDI" "Benin|BEN" "Saint BarthÃ©lemy|BLM" "Bermuda|BMU" "Brunei|BRN" "Bolivia|BOL" "Bonaire, Saint Eustatius, and Saba|BES" "Brazil|BRA" "Bahamas|BHS" "Bhutan|BTN" "Bouvet Island|BVT" "Botswana|BWA" "Belarus|BLR" "Belize|BLZ" "Canada|CAN" "Cocos (Keeling) Islands|CCK" "Congo (DRC)|COD" "Central African Republic|CAF" "Congo (Republic)|COG" "Switzerland|CHE" "Ivory Coast|CIV" "Cook Islands|COK" "Chile|CHL" "Cameroon|CMR" "China|CHN" "Colombia|COL" "Costa Rica|CRI" "Cuba|CUB" "Cape Verde|CPV" "CuraÃ§ao|CUW" "Christmas Island|CXR" "Cyprus|CYP" "Czech Republic|CZE" "Germany|DEU" "Djibouti|DJI" "Denmark|DNK" "Dominica|DMA" "Dominican Republic|DOM" "Algeria|DZA" "Ecuador|ECU" "Estonia|EST" "Egypt|EGY" "Western Sahara|ESH" "Eritrea|ERI" "Spain|ESP" "Ethiopia|ETH" "Finland|FIN" "Fiji|FJI" "Falkland Islands (Islas Malvinas)|FLK" "Micronesia|FSM" "Faroe Islands|FRO" "France|FRA" "Gabon|GAB" "United Kingdom|GBR" "Grenada|GRD" "Georgia|GEO" "French Guiana|GUF" "Guernsey|GGY" "Ghana|GHA" "Gibraltar|GIB" "Greenland|GRL" "Gambia|GMB" "Guinea|GIN" "Guadeloupe|GLP" "Equatorial Guinea|GNQ" "Greece|GRC" "South Georgia and the South Sandwich Islands|SGS" "Guatemala|GTM" "Guam|GUM" "Guinea-Bissau|GNB" "Guyana|GUY" "Hong Kong|HKG" "Heard Island and McDonald Islands|HMD" "Honduras|HND" "Croatia|HRV" "Haiti|HTI" "Hungary|HUN" "Indonesia|IDN" "Ireland|IRL" "Israel|ISR" "Isle of Man|IMN" "India|IND" "British Indian Ocean Territory|IOT" "Iraq|IRQ" "Iran|IRN" "Iceland|ISL" "Italy|ITA" "Jersey|JEY" "Jamaica|JAM" "Jordan|JOR" "Japan|JPN" "Kenya|KEN" "Kyrgyzstan|KGZ" "Cambodia|KHM" "Kiribati|KIR" "Comoros|COM" "Saint Kitts and Nevis|KNA" "North Korea|PRK" "South Korea|KOR" "Kuwait|KWT" "Cayman Islands|CYM" "Kazakhstan|KAZ" "Laos|LAO" "Lebanon|LBN" "Saint Lucia|LCA" "Liechtenstein|LIE" "Sri Lanka|LKA" "Liberia|LBR" "Lesotho|LSO" "Luxembourg|LUX" "Latvia|LVA" "Libya|LBY" "Morocco|MAR" "Monaco|MCO" "Moldova|MDA" "Montenegro|MNE" "Madagascar|MDG" "Marshall Islands|MHL" "Macedonia (FYROM)|MKD" "Mali|MLI" "Myanmar (Burma)|MMR" "Mongolia|MNG" "Macau|MAC" "Northern Mariana Islands|MNP" "Martinique|MTQ" "Mauritania|MRT" "Montserrat|MSR" "Malta|MLT" "Mauritius|MUS" "Maldives|MDV" "Malawi|MWI" "Mexico|MEX" "Malaysia|MYS" "Mozambique|MOZ" "Namibia|NAM" "New Caledonia|NCL" "Niger|NER" "Norfolk Island|NFK" "Nigeria|NGA" "Nicaragua|NIC" "Netherlands|NLD" "Norway|NOR" "Nepal|NPL" "Nauru|NRU" "Niue|NIU" "New Zealand|NZL" "Oman|OMN" "Panama|PAN" "Peru|PER" "French Polynesia|PYF" "Papua New Guinea|PNG" "Philippines|PHL" "Pakistan|PAK" "Poland|POL" "Saint Pierre and Miquelon|SPM" "Pitcairn Islands|PCN" "Puerto Rico|PRI" "Palestinian Territories|PSE" "Portugal|PRT" "Palau|PLW" "Paraguay|PRY" "Qatar|QAT" "RÃ©union|REU" "Romania|ROU" "Serbia|SRB" "Russia|RUS" "Rwanda|RWA" "Saudi Arabia|SAU" "Solomon Islands|SLB" "Seychelles|SYC" "Sudan|SDN" "Sweden|SWE" "Singapore|SGP" "Saint Helena|SHN" "Slovenia|SVN" "Svalbard and Jan Mayen|SJM" "Slovakia|SVK" "Sierra Leone|SLE" "San Marino|SMR" "Senegal|SEN" "Somalia|SOM" "Suriname|SUR" "SÃ£o TomÃ© and PrÃ­ncipe|STP" "El Salvador|SLV" "Sint Maarten|SXM" "Syria|SYR" "Swaziland|SWZ" "Turks and Caicos Islands|TCA" "Chad|TCD" "French Southern Territories|ATF" "Togo|TGO" "Thailand|THA" "Tajikistan|TJK" "Tokelau|TKL" "East Timor|TLS" "Turkmenistan|TKM" "Tunisia|TUN" "Tonga|TON" "Turkey|TUR" "Trinidad and Tobago|TTO" "Tuvalu|TUV" "Taiwan|TWN" "Tanzania|TZA" "Ukraine|UKR" "Uganda|UGA" "U.S. Minor Outlying Islands|UMI" "Uruguay|URY" "Uzbekistan|UZB" "Vatican City|VAT" "Saint Vincent and the Grenadines|VCT" "Venezuela|VEN" "British Virgin Islands|VGB" "U.S. Virgin Islands|VIR" "Vietnam|VNM" "Vanuatu|VUT" "Wallis and Futuna|WLF" "Samoa|WSM" "Yemen|YEM" "Mayotte|MYT" "South Africa|ZAF" "Zambia|ZMB" "Zimbabwe|ZWE" "United States|USA" "South Sudan|SSD"]
[text* teamgate-address-2-state class=form-control placeholder "*Province"]
[text* teamgate-address-2-street class=form-control placeholder "*Street, Number"]
[text* teamgate-address-2-city class=form-control placeholder "*City"]
[text* teamgate-address-2-zip class=form-control placeholder "*Postal Code"]
```
Or tags from multiple fields are merged into one list:
```
[text teamgate-tags class=form-control placeholder "Tags"]
[select* teamgate-tags-2 first_as_label "*Tags2?" "OOP" "Clock"]
[checkbox* teamgate-tags-1 include_blank *Tags? "Hey" "Bam" "Bim"]
```
Or with urls/phones/emails:
```
[email teamgate-email "Email Address"]
[hidden teamgate-email-2-type "home"]
[email teamgate-email-2 "Email Address 2"]
```
Same applies to urls and phones.

5. Allow to attach files to entity, by adding file fields to form. If `teamgate-entry-handler` submit button is present all files will be forwarded to teamgate.

Contact us for more for additional features.

== Installation ==

1. Install the plug-in from the WordPress plug-in installer or upload `plug-in` to the `/wp-content/plugins/` directory
2. Activate the plug-in through the `Plug-ins` menu in WordPress
3. Enter your Teamgate `APP_KEY` from your `Your Teamgate account -> Settings -> Additional Features -> External Apps` and your `AUTH_TOKEN` from `Your Teamgate account -> My Profile -> Preferences`.
4. Go to `Contact` forms and create a form (according to the requirements)[https://support.teamgate.com/hc/en-us/articles/115000137009]
5. You’ll see a form code like this: `[contact-form-7 id="1234" title="Contact form 1"]`
6. Paste this code into the contents of the page through page editor. 
7. Now your Teamgate form setup is complete. Visitors to your site can now find the form and start submitting leads to you.

== Frequently asked questions ==

If you think, that you found a bug in our Teamgate CRM Forms plugin or have any question contact us at [support@teamgate.com](mailto:support@teamgate.com)

== Screenshots ==

1. assets/screenshot-1.png
2. assets/screenshot-2.png
3. assets/screenshot-3.png
4. assets/screenshot-4.png
5. assets/screenshot-5.png

== Changelog ==
**1.6.3**
* Make submit button inherit default cf7 button behaviour to avoid compatability issues.

**1.6.2**
* Fix add submit spinner aka. adding default submit handler to submit button of CF7 form.

**1.6.1**
* Fix bug with file attachments, when no files are attached.

**1.6**
* Added file attachments support.

**1.5**
* Fixed bug with selectable fields that posts to teamgate api value as array even when it is supposed to be single value.
* Replaced deprecated method calls with up-to-date ones. (make sure you use latest CF7 version)
* Added ability to add multpile addresses, tags, emails, phones, urls to contact.

**1.4**
* Fixed activation bug, where wrong function name was used for activation of a plugin.
* Replaced `wpcf7_add_form_shortcode` with `wpcf7_add_form_tag` for registering teamgate fields

**1.3**
* Added ability to post countries ISO 3166-1 alpha-3 codes to Teamgate API.

**1.2.1**
* Fixed bug of the entry type.

**1.2**
* Fixed compatibility issues with Contact Form 7.

**1.1**
* Added ability to post custom data fields to Teamgate API.

**1.0**
* Allows to embed Teamgate form to WordPress blog post.

== Upgrade Notice ==

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.