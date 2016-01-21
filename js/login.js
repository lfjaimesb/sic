'use strict';
/*** login.js ***/

SicApp.controller('LoginCtrl', function($scope, Api, $location, $interval) {
    $scope.btnDisabled = false;
    $scope.response = false;
    $scope.tresta = 15;

    $scope.signin = function() {
        var formData = {
            usuario: $scope.user,
            password: $scope.password
        }

        Api.signin(formData).then(function(res){
            if(res.error == undefined) $location.path("/load");
        });
    };
});
