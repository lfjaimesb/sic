'use strict';
/*** load.js ***/

SicApp.controller('LoadCtrl', function($scope, Api, $location, $http, urls) {
    $scope.$on('$viewContentLoaded', function() {
        $http.post(urls.BASE_API +'/listas')
        .then(
            function(response){
                Api.setInfo(response.data);
                $location.path("/home");
            },
            function(response){
                $scope.addAlert("danger", response.data.error);
                Api.logout(function(){
                    $location.path("/login");
                });
            }
        );
    });
});
