'use strict';
/*** menu.js ***/
SicApp.controller("MenuCtrl", function($scope, $rootScope, Api, $location){

    $scope.menus = [
        {icono:'empresa.png', link:'empresas', titulo:"Empresa"},
        {icono:'cuentas.png', link:'cuentas', titulo:"Cuentas"},
        {icono:'polizas.png', link:'polizas', titulo:"Polizas"},
        {icono:'papeles.png', link:'papeles', titulo:"Papeles"},
        {icono:'reportes.png', link:'reportes', titulo:"Reportes"},
        {icono:'salir.png', link:'salir', titulo:"Salir"}
    ];

    $rootScope.navAction = function(option){
        if(option == "salir"){
            Api.logout(function(){
                $scope.swMenu = false;
                $location.path("/");
            });
        }else{
            $location.path("/"+option);
        }
    }

    $scope.navClass = function (page) {
        var currentRoute = $location.path().substring(1) || 'home';
        return page === currentRoute ? 'selected' : '';
    };

});

SicApp.controller("windowsCtrl", function($scope, $rootScope){
    $scope.windows = [];
    var iconos = {empresas: "empresa.png", cuentas:'cuentas.png', polizas:'polizas.png', papeles:'papeles.png', reportes:'reportes.png', periodo:'reportes.png'};

    $rootScope.dock = function(ventana){
        var bdr = true;

        angular.forEach($scope.windows, function(win) {
            if (win.link == ventana){
                bdr = false;
                win.select = true;
            }else win.select = false;
        });

        if(bdr){
            $scope.windows.push({link:ventana,  icono: iconos[ventana], select:true});
        }
    };
});
