'use strict';
/*** home.js ***/

SicApp.controller('EmpresasCtrl',function($scope, Api) {
    $scope.triggerUpload = function(inputFile){
        document.getElementById(inputFile).click();
    };

    $scope.$watch("empresa.rfc", function(newValue, oldValue){
        if(newValue.length == 13){
            $scope.fisica = true;
            $scope.regimenes = $scope.regimes.fisica;
        } else{
            $scope.fisica = false;
            $scope.regimenes = $scope.regimes.moral;
        }
    });

    $scope.save = function(){
        Api.save($scope.fkey, $scope.fcert, $scope.flogo);
    };

    $scope.dock("empresas");
});
