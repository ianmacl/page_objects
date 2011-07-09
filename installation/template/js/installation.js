/**
 * @version		$Id: installation.js 20226 2011-01-09 23:33:13Z eddieajau $
 * @package		Joomla.Installation
 * @subpackage	JavaScript
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Only define the Install namespace if not defined.
if (typeof(Install) === 'undefined') {
	var Install = {};
};

Install.submitform = function(task) {
	var form = document.id('adminForm');
	Joomla.submitform(task, form);
}

/**
 * Method to install sample data via AJAX request.
 */
Install.sampleData = function(el, filename) {
	// make the ajax call
	el = $(el);
	filename = $(filename);
	var req = new Request({
		method: 'get',
		url: 'index.php?'+document.id(el.form).toQueryString(),
		data: {'task':'setup.loadSampleData', 'format':'json'},
		onRequest: function() {
			el.set('disabled', 'disabled');
			filename.set('disabled', 'disabled');
			$('theDefaultError').setStyle('display','none');
		},
		onComplete: function(response) {
			try {
				var r = JSON.decode(response);
			} catch(e) {
				var r = false;
			}

			if (r)
			{
				Joomla.replaceTokens(r.token);
				if (r.error == false) {
					el.set('value', r.data.text);
					el.set('onclick','');
					el.set('disabled', 'disabled');
					filename.set('disabled', 'disabled');
					$('jform_sample_installed').set('value','1');
				}
				else
				{
					$('theDefaultError').setStyle('display','block');
					$('theDefaultErrorMessage').set('html', r.message);
					el.set('disabled', '');
					filename.set('disabled', '');
				}
			}
			else
			{
				$('theDefaultError').setStyle('display','block');
				$('theDefaultErrorMessage').set('html', response );
				el.set('disabled', 'disabled');
				filename.set('disabled', 'disabled');
			}
		},
		onFailure: function(xhr) {
			var r = JSON.decode(xhr.responseText);
			if (r)
			{
				Joomla.replaceTokens(r.token);
				$('theDefaultError').setStyle('display','block');
				$('theDefaultErrorMessage').set('html', r.message);
			}
			el.set('disabled', '');
			filename.set('disabled', '');
		}
	}).send();
};

/**
 * Method to detect the FTP root via AJAX request.
 */
Install.detectFtpRoot = function(el) {
	// make the ajax call
	el = $(el);
	var req = new Request({
		method: 'get',
		url: 'index.php?'+document.id(el.form).toQueryString(),
		data: {'task':'setup.detectFtpRoot', 'format':'json'},
		onRequest: function() { el.set('disabled', 'disabled'); },
		onFailure: function(xhr) {
			var r = JSON.decode(xhr.responseText);
			if (r)
			{
				Joomla.replaceTokens(r.token)
				alert(xhr.status+': '+r.message);
			}
			else
			{
				alert(xhr.status+': '+xhr.statusText);
			}				
		},
		onComplete: function(response) {
			var r = JSON.decode(response);
			if (r)
			{
				Joomla.replaceTokens(r.token)
				if (r.error == false) {
					document.id('jform_ftp_root').set('value', r.data.root);
				}
				else {
					alert(r.message);
				}
			}
			el.set('disabled', '');
		}
	}).send();
};

/**
 * Method to detect the FTP root via AJAX request.
 */
Install.verifyFtpSettings = function(el) {
	// make the ajax call
	el = $(el);
	var req = new Request({
		method: 'get',
		url: 'index.php?'+document.id(el.form).toQueryString(),
		data: {'task':'setup.verifyFtpSettings', 'format':'json'},
		onRequest: function() { el.set('disabled', 'disabled'); },
		onFailure: function(xhr) {
			var r = JSON.decode(xhr.responseText);
			if (r)
			{
				Joomla.replaceTokens(r.token)
				alert(xhr.status+': '+r.message);
			}
			else
			{
				alert(xhr.status+': '+xhr.statusText);
			}				
		},
		onComplete: function(response) {
			var r = JSON.decode(response);
			if (r)
			{
				Joomla.replaceTokens(r.token)
				if (r.error == false) {
					alert(Joomla.JText._('INSTL_FTP_SETTINGS_CORRECT'));
				}
				else {
					alert(r.message);
				}
			}
			el.set('disabled', '');
		},
		onError: function(response) {
			alert('error');
		}
	}).send();
};
