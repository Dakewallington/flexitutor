
flexApp.config(function($mdThemingProvider)
{
	$mdThemingProvider.definePalette('custom', 
	{
		'50': 'ffebee',
		'100': '05AA81',
		'200': '19af92',
		'300': '19af92',
		'400': '19af92',
		'500': '19af92',
		'600': '19af92',
		'700': 'd32f2f',
		'800': 'c62828',
		'900': '19af92',
		'A100': 'e7e7e7',
		'A200': '19af92',
		'A400': 'ff1744',
		'A700': 'd50000',
		'contrastDefaultColor': 'light',    // whether, by default, text (contrast)
											// on this palette should be dark or light
		'contrastDarkColors': ['50', '100', //hues which contrast should be 'dark' by default
		 '200', '300', '400', 'A100'],
		'contrastLightColors': ['50', '100', //hues which contrast should be 'dark' by default
		 '200', '300', '400', 'A100']   // could also specify this if default was 'dark'
  });
	$mdThemingProvider.theme('default').primaryPalette('custom');
	$mdThemingProvider.theme('default').backgroundPalette('custom');
});