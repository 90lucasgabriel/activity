(function () {
	"use strict";

	var app = angular.module('app.controllers');
	app.controller('ProjectEditController', ProjectEditController);

	ProjectEditController.$inject = [
		'$scope', '$routeParams', '$location', '$cookies', 
		'Project', 'Client', 'appConfig'];

	function ProjectEditController(
		$scope, $routeParams, $location, $cookies, 
		Project, Client, appConfig){

		$scope.project = Project.get({id: $routeParams.id});
		Project.get({id: $routeParams.id}, function(data){
			$scope.project = data;
			$scope.clientSelected = data.client.data;
		});
		$scope.status  = appConfig.project.status;
		$scope.due_date = {
			status: {
				opened: false
			}
		};

		$scope.save = function(){
			if($scope.form.$valid){
				$scope.project.owner_id = $cookies.getObject('user').id;
				Project.update(
					{id: $scope.project.project_id}, 
					$scope.project, 
					function(){
						$location.path('/project');	
					}
				);
			}
		};

		
		$scope.formatName = function(model){
			if(model){
				return model.name;
			}
			return '';
		};

		$scope.getClients = function(name){
			return Client.query({
				search: name,
				searchFields: 'name:like'
			}).$promise;
		};

		$scope.selectClient = function(item){
			$scope.project.client_id = item.id;
		};

		$scope.open = function($event) {
			$scope.due_date.status.opened = true;
		};

	};
})();