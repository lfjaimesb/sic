SicApp.controller('PeriodoCtrl', function ($scope, $uibModalInstance, $http, $localStorage, urls, data) {

  $scope.Periodo = data[0];
  $scope.Ejercicio = data[1];

  $scope.ok = function () {
      $http.post(urls.BASE_API +'/periodos/nvo', {"periodo": data[0], "ejercicio": data[1]})
      .success(function(response){
          $uibModalInstance.closer(response);
      });
      //console.log($localStorage.token);
  };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});
