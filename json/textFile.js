//JSON which storage for the meSpeak or machine talk for meSpeakMode lines
// This is American English MeSpeak Mode

var visualLogIntro = 
[
	{
		text : "For Audio mode, Press Ctrl A", speed : 155 //this if person who is blind want enter audio mode
	}
];

var logInput = 
[
	{
		text: "Email Address"	
	},
	{
		text: "Password"	
	}
];


var logKeyMessage = 
[
	{	//speed is rate by Word per Minute since we dont have access the user WPM data	
		text : "Press Ctrl A, to toggle audio mode", speed: 155 //this if person F1 on log and say email
	},
	{	//speed is rate by Word per Minute since we dont have access the user WPM data	
		text : "Press f2, to select email address", speed: 155 //this if person F1 on log and say email
	},
	{
		text : "Press f3, to select password", speed: 155 //this if person F1 on log and say password
	},
	{
		text : "Press f4, to enter or submit", speed: 155 //this if person F1 on log and say enter email
	}
];

var logErrorMessage = 
[
	{
		text: "Type, email address", speed: 155 
	},
	{
		text: "Type, password", speed: 155	
	},
	{
		text: "Missing, email address", speed: 155	
	},
	{
		text: "Missing, password", speed: 155	
	},
	{
		text : "SERVER ERROR: Server cant not be reach at this time. Please try again later.", speed: 155	
	},
	{
		text : "ERROR: Your username or password is incorrect.", speed: 155
	},
	{
		text : "Need help? Press F1", speed: 155
	}
];

//JSON for Page.
var menuGreetings =
[
	{ 
		text: 'dashboard', id: 'dashboard.php'
	},
	{
		 text: 'manageusers', id: 'manageusers.php'
	},
	{ 
		text: 'activity lessons', id: 'activity.php'
	},
	{ 
		text: 'Analytics', id: 'indivanalytics.php'
	},
	{ 
		text: 'Global, Analytics', id: 'globalanalytics.php'
	},
	{ 
		text: 'Profile', id: 'account.php'
	},
	{
		text: 'Mespeak, Settings', id: 'mespeak.php'
	},
	{
		text: 'Welcome, please Sign In', id: 'signin.php'
	}
];

var menuGreatingPartTwo =
[
	{
		text: 'Press f1, for page help'
	},
	{
		text: 'Press f2, to hear the, pages navigation'
	}
];

var navigationHelp =
[
	{
		text: 'Press Alt and the 1 key, to transfer to Dashboard'
	},
	{
		text: 'Press Alt and the 2 key, to transfer  to manage users'
	},
	{
		text: 'Press Alt and the 3 key, to transfer  to activity lessons'
	},
	{
		text: 'Press Alt and the 4 key, to transfer  to your analytics'
	},
	{
		text: 'Press Alt and the 5 key, to transfer  to member analytics'
	},
	{
		text: 'Press Alt and the 6 key, to transfer  to account settings'
	},
	{
		text: 'Press Alt and the 7 key, to transfer  to Activity settings' 
	},
	{
		text: 'Press Alt and the 8 key, to transfer  to meSpeak settings'
	}
	
];

var pageHelp =
[
	{
		'id': 'signin.php', 
		'menuOptions': 
		[
			{	//speed is rate by Word per Minute since we dont have access the user WPM data	
				"text" : "Press up arrow, to select email address",
				"speed": 155 //this if person F1 on log and say email
			},
			{
				"text" : "Press down, arrow to select password",
				"speed": 155 //this if person F1 on log and say password
			},
			{
				"text" : "Press enter, to attempt sign in",
				"speed": 155 //this if person F1 on log and say enter email
			}
		]	
	}
];
