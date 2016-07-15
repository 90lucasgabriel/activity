(function () {
	"use strict";

	var app = angular.module('app.services');
	app.service('ProjectMember', ProjectMember);

	ProjectMember.$inject = ['$resource','$filter','appConfig'];

	function ProjectMember($resource, $filter, appConfig){
		return $resource(appConfig.baseUrl + '/project/:id/member/:projectMemberId', 
			{
				id: '@id',
				projectMemberId: '@projectMemberId'
			},
			{		
				update: {
					method: 'PUT',
					headers: {
				        'content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
				    }
				}
			}
		);
	};
	
})();
