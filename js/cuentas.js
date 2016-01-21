'use strict';
/*** cuentas.js ***/

SicApp.controller('CuentasCtrl', function($scope, $uibModal){
    $scope.rubros.selected = $scope.rubros[0];

    $scope.verify = function(cuenta){
        var rubro = $scope.rubros.selected.id_rubro;

        if(rubro == 0 || cuenta.rubros.indexOf(rubro) != -1) return true;

        return false;
    };

    $scope.btnAdd = function () {
        var modalInstance = $uibModal.open({
          templateUrl: 'views/addcuentas.html?nd=' + Date.now(),
          controller: 'AddCuentasCtrl',
          size: 'lg'
        });
    };

    $scope.dock("cuentas");
});

SicApp.controller('AddCuentasCtrl', function($scope, $uibModalInstance, $http, urls){
    $scope.save = function(){

    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});

SicApp.directive("clave", function($timeout){
    return {
        restrict: 'E',
        link: function(scope, iElement, iAttrs){
            var tmp = [];
            var inicial = 0;

            angular.forEach(scope.empresa.nivel, function(nivel) {
                tmp.push(iAttrs.dato.substr(inicial, nivel));
                inicial += parseInt(nivel);
            });

            iElement.text(tmp.join("-"));
        }
    };
});
