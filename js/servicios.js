'use strict';
/*** Servicios.js ***/

SicApp.factory('Api', function($rootScope, $http, $localStorage, urls){
    var service = {};

    service.urlBase64Decode = function(str){
        var output = str.replace('-', '+').replace('_', '/');
        switch (output.length % 4) {
            case 0:
                break;
            case 2:
                output += '==';
                break;
            case 3:
                output += '=';
                break;
            default:
                throw 'Illegal base64url string!';
        }
        return window.atob(output);
    };

    service.setToken = function(data){
        $localStorage.sicToken = data;

        service.getToken();
    };

    service.getToken = function() {
        var token = $localStorage.sicToken;

        if (typeof token !== 'undefined') {
            var encoded = token.split('.')[1];
            var user = JSON.parse(service.urlBase64Decode(encoded));
            user.data.exp = user.exp;

            $rootScope.usuario = user.data;

            return true;
        }

        return false;
    };

    service.signin = function(data) {
        var formData = new FormData();
        formData.append("usuario", data.usuario);
        formData.append("password", data.password);

        return $http.post(
            urls.BASE_API +'/usuarios/authenticate',
            formData,
            {headers: {"Content-type": undefined}, transformRequest: angular.identify}
        )
        .then(
            function(response){
                service.setToken(response.data.token);
                return response.data;
            },
            function(response){
                $rootScope.addAlert("danger", response.data.error);
                return response.data;
            }
        );
    };

    service.logout = function(success) {
        delete $localStorage.sicToken;
        delete $localStorage.sicData;
        success();
    };

    service.setInfo = function(data){
        $localStorage.sicData = data;

        service.getInfo();
    };

    service.getInfo = function() {
        var sicData = $localStorage.sicData;

        if (typeof sicData !== 'undefined') {

            angular.forEach(sicData, function(sic, key) {
                $rootScope[key] = sic;
            });

            $rootScope.swMenu = true;

            return true;
        }

        return false;
    };

    service.save = function(f1, f2, f3){

        var formData = new FormData();
        formData.append("id_empresa", $rootScope.empresa.id_empresa);
        formData.append("iva", $rootScope.empresa.iva?1:0);
        formData.append("isr", $rootScope.empresa.isr?1:0);
        formData.append("id_regimen", $rootScope.empresa.regimen.id_regimen);
        formData.append("persona", $rootScope.empresa.regimen.persona);
        formData.append("tolerancia", $rootScope.empresa.tolerancia);
        formData.append("nombre", $rootScope.empresa.nombre);
        formData.append("curp", $rootScope.empresa.curp);
        formData.append("rfc", $rootScope.empresa.rfc);
        formData.append("direccion", $rootScope.empresa.direccion);
        formData.append("colonia", $rootScope.empresa.colonia);
        formData.append("cp", $rootScope.empresa.cp);
        formData.append("estado", $rootScope.empresa.estado);
        formData.append("pais", $rootScope.empresa.pais);
        formData.append("contacto", $rootScope.empresa.contacto);
        formData.append("telefono", $rootScope.empresa.telefono);
        formData.append("csd", $rootScope.empresa.csd);
        formData.append("email", $rootScope.empresa.email);
        formData.append("niveles", $rootScope.empresa.nivel.join());

        if(f1 != undefined) formData.append("fkey", f1);
        if(f2 != undefined) formData.append("fcer", f2);
        if(f3 != undefined) formData.append("flogo", f3);

        return $http.post(
            urls.BASE_API +'/empresas/save',
            formData,
            {headers: {"Content-type": undefined}, transformRequest: angular.identify}
        )
        .then(
            function(response){
                $rootScope.addAlert("success", response.data.success);
                return response.data;
            },
            function(response){
                $rootScope.addAlert("danger", response.data.error);
                return response.data;
            }
        );
    };

    return service;
});
