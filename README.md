ATLauncher API Implementation
=============================

### What is it?
Open-source implementation of the ATLauncher API.

### Links
[ATLauncher Website](http://www.atlauncher.com)

[ATLauncher Github](https://github.com/ATLauncher/ATLauncher)

[ATLauncher-API-Examples](https://github.com/lexware/ATLauncher-API-Examples)

### Collaborators
The only person but myself who has access to modify this project without having to make pull requests, is RyanTheAlmighty, I have given him collaborator permission if in the unlikely case he wishes to fix or amend something in the code.

### Things to Note
I am sorry if you find this poorly-coded and or a bad-implementation, however on my behalf I last did PHP 4 years ago, for a short period of time, as of now I am teaching myself PHP (like I do all programming languages), to improve upon what I would say is an alright basis for my implementation of the ATLauncher API.

### Plugging In Your Data
To get started with the code and plug in your own data, you need to create a constants.php file. Below is a starter to get you going:

    <?php
		$url_cutoff = '/something/api/'; 
		$host = 'host';
		$user = 'user';
		$password = 'password';
		$database = 'db';
	?>
	
### Usage
You may be wondering how or why use this API, so as well as telling you to look at the ATLauncher wiki, I have made a bunch examples in php, over [here](https://github.com/lexware/ATLauncher-API-Examples).
