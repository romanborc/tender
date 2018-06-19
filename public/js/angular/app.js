(function () {
	"use strict";
	angular.module('tender', [
		'tender.routes',
		'tender.controllers',
		'tender.directives',
		'tender.services',
	]).config(function($interpolateProvider) {
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	});

	angular.module('tender.routes', ['ngRoute']);
	angular.module('tender.controllers', ['ui.bootstrap', 'ngSanitize']);
	angular.module('tender.directives', []);
	angular.module('tender.services', ['ngResource']);
}());