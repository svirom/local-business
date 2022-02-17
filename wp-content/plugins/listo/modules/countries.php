<?php
/**
 * The list of countries and dependent territories based on ISO 3166 standard.
 *
 * Source: https://en.wikipedia.org/wiki/ISO_3166-1 ISO 3166-1
 */
class Listo_Countries implements Listo {
	private function __construct() {}

	public static function items() {
		return array(
			'abw' => _x( "Aruba", 'countries', 'listo' ),
			'afg' => _x( "Afghanistan", 'countries', 'listo' ),
			'ago' => _x( "Angola", 'countries', 'listo' ),
			'aia' => _x( "Anguilla", 'countries', 'listo' ),
			'ala' => _x( "Åland Islands", 'countries', 'listo' ),
			'alb' => _x( "Albania", 'countries', 'listo' ),
			'and' => _x( "Andorra", 'countries', 'listo' ),
			'are' => _x( "United Arab Emirates", 'countries', 'listo' ),
			'arg' => _x( "Argentina", 'countries', 'listo' ),
			'arm' => _x( "Armenia", 'countries', 'listo' ),
			'asm' => _x( "American Samoa", 'countries', 'listo' ),
			'ata' => _x( "Antarctica", 'countries', 'listo' ),
			'atf' => _x( "French Southern Territories", 'countries', 'listo' ),
			'atg' => _x( "Antigua and Barbuda", 'countries', 'listo' ),
			'aus' => _x( "Australia", 'countries', 'listo' ),
			'aut' => _x( "Austria", 'countries', 'listo' ),
			'aze' => _x( "Azerbaijan", 'countries', 'listo' ),
			'bdi' => _x( "Burundi", 'countries', 'listo' ),
			'bel' => _x( "Belgium", 'countries', 'listo' ),
			'ben' => _x( "Benin", 'countries', 'listo' ),
			'bes' => _x( "Bonaire, Sint Eustatius and Saba", 'countries', 'listo' ),
			'bfa' => _x( "Burkina Faso", 'countries', 'listo' ),
			'bgd' => _x( "Bangladesh", 'countries', 'listo' ),
			'bgr' => _x( "Bulgaria", 'countries', 'listo' ),
			'bhr' => _x( "Bahrain", 'countries', 'listo' ),
			'bhs' => _x( "Bahamas", 'countries', 'listo' ),
			'bih' => _x( "Bosnia and Herzegovina", 'countries', 'listo' ),
			'blm' => _x( "Saint Barthélemy", 'countries', 'listo' ),
			'blr' => _x( "Belarus", 'countries', 'listo' ),
			'blz' => _x( "Belize", 'countries', 'listo' ),
			'bmu' => _x( "Bermuda", 'countries', 'listo' ),
			'bol' => _x( "Bolivia, Plurinational State of", 'countries', 'listo' ),
			'bra' => _x( "Brazil", 'countries', 'listo' ),
			'brb' => _x( "Barbados", 'countries', 'listo' ),
			'brn' => _x( "Brunei Darussalam", 'countries', 'listo' ),
			'btn' => _x( "Bhutan", 'countries', 'listo' ),
			'bvt' => _x( "Bouvet Island", 'countries', 'listo' ),
			'bwa' => _x( "Botswana", 'countries', 'listo' ),
			'caf' => _x( "Central African Republic", 'countries', 'listo' ),
			'can' => _x( "Canada", 'countries', 'listo' ),
			'cck' => _x( "Cocos (Keeling) Islands", 'countries', 'listo' ),
			'che' => _x( "Switzerland", 'countries', 'listo' ),
			'chl' => _x( "Chile", 'countries', 'listo' ),
			'chn' => _x( "China", 'countries', 'listo' ),
			'civ' => _x( "Côte d'Ivoire", 'countries', 'listo' ),
			'cmr' => _x( "Cameroon", 'countries', 'listo' ),
			'cod' => _x( "Congo, the Democratic Republic of the", 'countries', 'listo' ),
			'cog' => _x( "Congo", 'countries', 'listo' ),
			'cok' => _x( "Cook Islands", 'countries', 'listo' ),
			'col' => _x( "Colombia", 'countries', 'listo' ),
			'com' => _x( "Comoros", 'countries', 'listo' ),
			'cpv' => _x( "Cape Verde", 'countries', 'listo' ),
			'cri' => _x( "Costa Rica", 'countries', 'listo' ),
			'cub' => _x( "Cuba", 'countries', 'listo' ),
			'cuw' => _x( "Curaçao", 'countries', 'listo' ),
			'cxr' => _x( "Christmas Island", 'countries', 'listo' ),
			'cym' => _x( "Cayman Islands", 'countries', 'listo' ),
			'cyp' => _x( "Cyprus", 'countries', 'listo' ),
			'cze' => _x( "Czech Republic", 'countries', 'listo' ),
			'deu' => _x( "Germany", 'countries', 'listo' ),
			'dji' => _x( "Djibouti", 'countries', 'listo' ),
			'dma' => _x( "Dominica", 'countries', 'listo' ),
			'dnk' => _x( "Denmark", 'countries', 'listo' ),
			'dom' => _x( "Dominican Republic", 'countries', 'listo' ),
			'dza' => _x( "Algeria", 'countries', 'listo' ),
			'ecu' => _x( "Ecuador", 'countries', 'listo' ),
			'egy' => _x( "Egypt", 'countries', 'listo' ),
			'eri' => _x( "Eritrea", 'countries', 'listo' ),
			'esh' => _x( "Western Sahara", 'countries', 'listo' ),
			'esp' => _x( "Spain", 'countries', 'listo' ),
			'est' => _x( "Estonia", 'countries', 'listo' ),
			'eth' => _x( "Ethiopia", 'countries', 'listo' ),
			'fin' => _x( "Finland", 'countries', 'listo' ),
			'fji' => _x( "Fiji", 'countries', 'listo' ),
			'flk' => _x( "Falkland Islands (Malvinas)", 'countries', 'listo' ),
			'fra' => _x( "France", 'countries', 'listo' ),
			'fro' => _x( "Faroe Islands", 'countries', 'listo' ),
			'fsm' => _x( "Micronesia, Federated States of", 'countries', 'listo' ),
			'gab' => _x( "Gabon", 'countries', 'listo' ),
			'gbr' => _x( "United Kingdom", 'countries', 'listo' ),
			'geo' => _x( "Georgia", 'countries', 'listo' ),
			'ggy' => _x( "Guernsey", 'countries', 'listo' ),
			'gha' => _x( "Ghana", 'countries', 'listo' ),
			'gib' => _x( "Gibraltar", 'countries', 'listo' ),
			'gin' => _x( "Guinea", 'countries', 'listo' ),
			'glp' => _x( "Guadeloupe", 'countries', 'listo' ),
			'gmb' => _x( "Gambia", 'countries', 'listo' ),
			'gnb' => _x( "Guinea-Bissau", 'countries', 'listo' ),
			'gnq' => _x( "Equatorial Guinea", 'countries', 'listo' ),
			'grc' => _x( "Greece", 'countries', 'listo' ),
			'grd' => _x( "Grenada", 'countries', 'listo' ),
			'grl' => _x( "Greenland", 'countries', 'listo' ),
			'gtm' => _x( "Guatemala", 'countries', 'listo' ),
			'guf' => _x( "French Guiana", 'countries', 'listo' ),
			'gum' => _x( "Guam", 'countries', 'listo' ),
			'guy' => _x( "Guyana", 'countries', 'listo' ),
			'hkg' => _x( "Hong Kong", 'countries', 'listo' ),
			'hmd' => _x( "Heard Island and McDonald Islands", 'countries', 'listo' ),
			'hnd' => _x( "Honduras", 'countries', 'listo' ),
			'hrv' => _x( "Croatia", 'countries', 'listo' ),
			'hti' => _x( "Haiti", 'countries', 'listo' ),
			'hun' => _x( "Hungary", 'countries', 'listo' ),
			'idn' => _x( "Indonesia", 'countries', 'listo' ),
			'imn' => _x( "Isle of Man", 'countries', 'listo' ),
			'ind' => _x( "India", 'countries', 'listo' ),
			'iot' => _x( "British Indian Ocean Territory", 'countries', 'listo' ),
			'irl' => _x( "Ireland", 'countries', 'listo' ),
			'irn' => _x( "Iran, Islamic Republic of", 'countries', 'listo' ),
			'irq' => _x( "Iraq", 'countries', 'listo' ),
			'isl' => _x( "Iceland", 'countries', 'listo' ),
			'isr' => _x( "Israel", 'countries', 'listo' ),
			'ita' => _x( "Italy", 'countries', 'listo' ),
			'jam' => _x( "Jamaica", 'countries', 'listo' ),
			'jey' => _x( "Jersey", 'countries', 'listo' ),
			'jor' => _x( "Jordan", 'countries', 'listo' ),
			'jpn' => _x( "Japan", 'countries', 'listo' ),
			'kaz' => _x( "Kazakhstan", 'countries', 'listo' ),
			'ken' => _x( "Kenya", 'countries', 'listo' ),
			'kgz' => _x( "Kyrgyzstan", 'countries', 'listo' ),
			'khm' => _x( "Cambodia", 'countries', 'listo' ),
			'kir' => _x( "Kiribati", 'countries', 'listo' ),
			'kna' => _x( "Saint Kitts and Nevis", 'countries', 'listo' ),
			'kor' => _x( "Korea, Republic of", 'countries', 'listo' ),
			'kwt' => _x( "Kuwait", 'countries', 'listo' ),
			'lao' => _x( "Lao People's Democratic Republic", 'countries', 'listo' ),
			'lbn' => _x( "Lebanon", 'countries', 'listo' ),
			'lbr' => _x( "Liberia", 'countries', 'listo' ),
			'lby' => _x( "Libya", 'countries', 'listo' ),
			'lca' => _x( "Saint Lucia", 'countries', 'listo' ),
			'lie' => _x( "Liechtenstein", 'countries', 'listo' ),
			'lka' => _x( "Sri Lanka", 'countries', 'listo' ),
			'lso' => _x( "Lesotho", 'countries', 'listo' ),
			'ltu' => _x( "Lithuania", 'countries', 'listo' ),
			'lux' => _x( "Luxembourg", 'countries', 'listo' ),
			'lva' => _x( "Latvia", 'countries', 'listo' ),
			'mac' => _x( "Macao", 'countries', 'listo' ),
			'maf' => _x( "Saint Martin (French part)", 'countries', 'listo' ),
			'mar' => _x( "Morocco", 'countries', 'listo' ),
			'mco' => _x( "Monaco", 'countries', 'listo' ),
			'mda' => _x( "Moldova, Republic of", 'countries', 'listo' ),
			'mdg' => _x( "Madagascar", 'countries', 'listo' ),
			'mdv' => _x( "Maldives", 'countries', 'listo' ),
			'mex' => _x( "Mexico", 'countries', 'listo' ),
			'mhl' => _x( "Marshall Islands", 'countries', 'listo' ),
			'mkd' => _x( "Macedonia, the former Yugoslav Republic of", 'countries', 'listo' ),
			'mli' => _x( "Mali", 'countries', 'listo' ),
			'mlt' => _x( "Malta", 'countries', 'listo' ),
			'mmr' => _x( "Myanmar", 'countries', 'listo' ),
			'mne' => _x( "Montenegro", 'countries', 'listo' ),
			'mng' => _x( "Mongolia", 'countries', 'listo' ),
			'mnp' => _x( "Northern Mariana Islands", 'countries', 'listo' ),
			'moz' => _x( "Mozambique", 'countries', 'listo' ),
			'mrt' => _x( "Mauritania", 'countries', 'listo' ),
			'msr' => _x( "Montserrat", 'countries', 'listo' ),
			'mtq' => _x( "Martinique", 'countries', 'listo' ),
			'mus' => _x( "Mauritius", 'countries', 'listo' ),
			'mwi' => _x( "Malawi", 'countries', 'listo' ),
			'mys' => _x( "Malaysia", 'countries', 'listo' ),
			'myt' => _x( "Mayotte", 'countries', 'listo' ),
			'nam' => _x( "Namibia", 'countries', 'listo' ),
			'ncl' => _x( "New Caledonia", 'countries', 'listo' ),
			'ner' => _x( "Niger", 'countries', 'listo' ),
			'nfk' => _x( "Norfolk Island", 'countries', 'listo' ),
			'nga' => _x( "Nigeria", 'countries', 'listo' ),
			'nic' => _x( "Nicaragua", 'countries', 'listo' ),
			'niu' => _x( "Niue", 'countries', 'listo' ),
			'nld' => _x( "Netherlands", 'countries', 'listo' ),
			'nor' => _x( "Norway", 'countries', 'listo' ),
			'npl' => _x( "Nepal", 'countries', 'listo' ),
			'nru' => _x( "Nauru", 'countries', 'listo' ),
			'nzl' => _x( "New Zealand", 'countries', 'listo' ),
			'omn' => _x( "Oman", 'countries', 'listo' ),
			'pak' => _x( "Pakistan", 'countries', 'listo' ),
			'pan' => _x( "Panama", 'countries', 'listo' ),
			'pcn' => _x( "Pitcairn", 'countries', 'listo' ),
			'per' => _x( "Peru", 'countries', 'listo' ),
			'phl' => _x( "Philippines", 'countries', 'listo' ),
			'plw' => _x( "Palau", 'countries', 'listo' ),
			'png' => _x( "Papua New Guinea", 'countries', 'listo' ),
			'pol' => _x( "Poland", 'countries', 'listo' ),
			'pri' => _x( "Puerto Rico", 'countries', 'listo' ),
			'prk' => _x( "Korea, Democratic People's Republic of", 'countries', 'listo' ),
			'prt' => _x( "Portugal", 'countries', 'listo' ),
			'pry' => _x( "Paraguay", 'countries', 'listo' ),
			'pse' => _x( "Palestine, State of", 'countries', 'listo' ),
			'pyf' => _x( "French Polynesia", 'countries', 'listo' ),
			'qat' => _x( "Qatar", 'countries', 'listo' ),
			'reu' => _x( "Réunion", 'countries', 'listo' ),
			'rou' => _x( "Romania", 'countries', 'listo' ),
			'rus' => _x( "Russian Federation", 'countries', 'listo' ),
			'rwa' => _x( "Rwanda", 'countries', 'listo' ),
			'sau' => _x( "Saudi Arabia", 'countries', 'listo' ),
			'sdn' => _x( "Sudan", 'countries', 'listo' ),
			'sen' => _x( "Senegal", 'countries', 'listo' ),
			'sgp' => _x( "Singapore", 'countries', 'listo' ),
			'sgs' => _x( "South Georgia and the South Sandwich Islands", 'countries', 'listo' ),
			'shn' => _x( "Saint Helena, Ascension and Tristan da Cunha", 'countries', 'listo' ),
			'sjm' => _x( "Svalbard and Jan Mayen", 'countries', 'listo' ),
			'slb' => _x( "Solomon Islands", 'countries', 'listo' ),
			'sle' => _x( "Sierra Leone", 'countries', 'listo' ),
			'slv' => _x( "El Salvador", 'countries', 'listo' ),
			'smr' => _x( "San Marino", 'countries', 'listo' ),
			'som' => _x( "Somalia", 'countries', 'listo' ),
			'spm' => _x( "Saint Pierre and Miquelon", 'countries', 'listo' ),
			'srb' => _x( "Serbia", 'countries', 'listo' ),
			'ssd' => _x( "South Sudan", 'countries', 'listo' ),
			'stp' => _x( "Sao Tome and Principe", 'countries', 'listo' ),
			'sur' => _x( "Suriname", 'countries', 'listo' ),
			'svk' => _x( "Slovakia", 'countries', 'listo' ),
			'svn' => _x( "Slovenia", 'countries', 'listo' ),
			'swe' => _x( "Sweden", 'countries', 'listo' ),
			'swz' => _x( "Swaziland", 'countries', 'listo' ),
			'sxm' => _x( "Sint Maarten (Dutch part)", 'countries', 'listo' ),
			'syc' => _x( "Seychelles", 'countries', 'listo' ),
			'syr' => _x( "Syrian Arab Republic", 'countries', 'listo' ),
			'tca' => _x( "Turks and Caicos Islands", 'countries', 'listo' ),
			'tcd' => _x( "Chad", 'countries', 'listo' ),
			'tgo' => _x( "Togo", 'countries', 'listo' ),
			'tha' => _x( "Thailand", 'countries', 'listo' ),
			'tjk' => _x( "Tajikistan", 'countries', 'listo' ),
			'tkl' => _x( "Tokelau", 'countries', 'listo' ),
			'tkm' => _x( "Turkmenistan", 'countries', 'listo' ),
			'tls' => _x( "Timor-Leste", 'countries', 'listo' ),
			'ton' => _x( "Tonga", 'countries', 'listo' ),
			'tto' => _x( "Trinidad and Tobago", 'countries', 'listo' ),
			'tun' => _x( "Tunisia", 'countries', 'listo' ),
			'tur' => _x( "Turkey", 'countries', 'listo' ),
			'tuv' => _x( "Tuvalu", 'countries', 'listo' ),
			'twn' => _x( "Taiwan, Province of China", 'countries', 'listo' ),
			'tza' => _x( "Tanzania, United Republic of", 'countries', 'listo' ),
			'uga' => _x( "Uganda", 'countries', 'listo' ),
			'ukr' => _x( "Ukraine", 'countries', 'listo' ),
			'umi' => _x( "United States Minor Outlying Islands", 'countries', 'listo' ),
			'ury' => _x( "Uruguay", 'countries', 'listo' ),
			'usa' => _x( "United States", 'countries', 'listo' ),
			'uzb' => _x( "Uzbekistan", 'countries', 'listo' ),
			'vat' => _x( "Holy See (Vatican City State)", 'countries', 'listo' ),
			'vct' => _x( "Saint Vincent and the Grenadines", 'countries', 'listo' ),
			'ven' => _x( "Venezuela, Bolivarian Republic of", 'countries', 'listo' ),
			'vgb' => _x( "Virgin Islands, British", 'countries', 'listo' ),
			'vir' => _x( "Virgin Islands, U.S.", 'countries', 'listo' ),
			'vnm' => _x( "Viet Nam", 'countries', 'listo' ),
			'vut' => _x( "Vanuatu", 'countries', 'listo' ),
			'wlf' => _x( "Wallis and Futuna", 'countries', 'listo' ),
			'wsm' => _x( "Samoa", 'countries', 'listo' ),
			'yem' => _x( "Yemen", 'countries', 'listo' ),
			'zaf' => _x( "South Africa", 'countries', 'listo' ),
			'zmb' => _x( "Zambia", 'countries', 'listo' ),
			'zwe' => _x( "Zimbabwe", 'countries', 'listo' ),
		);
	}

	public static function groups() {
		return array(
			'un' => array(
				'afg', 'ago', 'alb', 'and', 'are', 'arg', 'arm',
				'atg', 'aus', 'aut', 'aze', 'bdi', 'bel', 'ben', 'bfa', 'bgd',
				'bgr', 'bhr', 'bhs', 'bih', 'blr', 'blz', 'bol', 'bra', 'brb',
				'brn', 'btn', 'bwa', 'caf', 'can', 'che', 'chl', 'chn', 'civ',
				'cmr', 'cod', 'cog', 'col', 'com', 'cpv', 'cri', 'cub', 'cyp',
				'cze', 'deu', 'dji', 'dma', 'dnk', 'dom', 'dza', 'ecu', 'egy',
				'eri', 'esp', 'est', 'eth', 'fin', 'fji', 'fra', 'fsm', 'gab',
				'gbr', 'geo', 'gha', 'gin', 'gmb', 'gnb', 'gnq', 'grc', 'grd',
				'gtm', 'guy', 'hnd', 'hrv', 'hti', 'hun', 'idn', 'ind', 'irl',
				'irn', 'irq', 'isl', 'isr', 'ita', 'jam', 'jor', 'jpn', 'kaz',
				'ken', 'kgz', 'khm', 'kir', 'kna', 'kor', 'kwt', 'lao', 'lbn',
				'lbr', 'lby', 'lca', 'lie', 'lka', 'lso', 'ltu', 'lux', 'lva',
				'mar', 'mco', 'mda', 'mdg', 'mdv', 'mex', 'mhl', 'mkd', 'mli',
				'mlt', 'mmr', 'mne', 'mng', 'moz', 'mrt', 'mus', 'mwi', 'mys',
				'nam', 'ner', 'nga', 'nic', 'nld', 'nor', 'npl', 'nru', 'nzl',
				'omn', 'pak', 'pan', 'per', 'phl', 'plw', 'png', 'pol', 'prk',
				'prt', 'pry', 'qat', 'rou', 'rus', 'rwa', 'sau', 'sdn', 'sen',
				'sgp', 'slb', 'sle', 'slv', 'smr', 'som', 'srb', 'ssd', 'stp',
				'sur', 'svk', 'svn', 'swe', 'swz', 'syc', 'syr', 'tcd', 'tgo',
				'tha', 'tjk', 'tkm', 'tls', 'ton', 'tto', 'tun', 'tur', 'tuv',
				'tza', 'uga', 'ukr', 'ury', 'usa', 'uzb', 'vct', 'ven', 'vnm',
				'vut', 'wsm', 'yem', 'zaf', 'zmb', 'zwe',
			),
			'olympic' => array(
				'abw', 'afg', 'ago', 'alb', 'and', 'are', 'arg',
				'arm', 'asm', 'atg', 'aus', 'aut', 'aze', 'bdi', 'bel', 'ben',
				'bfa', 'bgd', 'bgr', 'bhr', 'bhs', 'bih', 'blr', 'blz', 'bmu',
				'bol', 'bra', 'brb', 'brn', 'btn', 'bwa', 'caf', 'can', 'che',
				'chl', 'chn', 'civ', 'cmr', 'cod', 'cog', 'cok', 'col', 'com',
				'cpv', 'cri', 'cub', 'cym', 'cyp', 'cze', 'deu', 'dji', 'dma',
				'dnk', 'dom', 'dza', 'ecu', 'egy', 'eri', 'esp', 'est', 'eth',
				'fin', 'fji', 'fra', 'fsm', 'gab', 'gbr', 'geo', 'gha', 'gin',
				'gmb', 'gnb', 'gnq', 'grc', 'grd', 'gtm', 'gum', 'guy', 'hkg',
				'hnd', 'hrv', 'hti', 'hun', 'idn', 'ind', 'irl', 'irn', 'irq',
				'isl', 'isr', 'ita', 'jam', 'jor', 'jpn', 'kaz', 'ken', 'kgz',
				'khm', 'kir', 'kna', 'kor', 'kwt', 'lao', 'lbn', 'lbr', 'lby',
				'lca', 'lie', 'lka', 'lso', 'ltu', 'lux', 'lva', 'mar', 'mco',
				'mda', 'mdg', 'mdv', 'mex', 'mhl', 'mkd', 'mli', 'mlt', 'mmr',
				'mne', 'mng', 'moz', 'mrt', 'mus', 'mwi', 'mys', 'nam', 'ner',
				'nga', 'nic', 'nld', 'nor', 'npl', 'nru', 'nzl', 'omn', 'pak',
				'pan', 'per', 'phl', 'plw', 'png', 'pol', 'pri', 'prk', 'prt',
				'pry', 'pse', 'qat', 'rou', 'rus', 'rwa', 'sau', 'sdn', 'sen',
				'sgp', 'slb', 'sle', 'slv', 'smr', 'som', 'srb', 'ssd', 'stp',
				'sur', 'svk', 'svn', 'swe', 'swz', 'syc', 'syr', 'tcd', 'tgo',
				'tha', 'tjk', 'tkm', 'tls', 'ton', 'tto', 'tun', 'tur', 'tuv',
				'twn', 'tza', 'uga', 'ukr', 'ury', 'usa', 'uzb', 'vct', 'ven',
				'vgb', 'vir', 'vnm', 'vut', 'wsm', 'yem', 'zaf', 'zmb', 'zwe',
			),
		);
	}
}
