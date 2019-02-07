(function () {

    var app = angular.module('secciones', []);

    /**
     * Cabecera con usuario sin loguear
     */
    app.directive('cabecerasinlogin', function () {
        return {
            restrict: 'E',
            templateUrl: '/damelapatita/secciones/cabecera.html'
        };
    }); // Fin cabecerasinlogin

    /**
    * Cabecera con usuario logueado
    */
    app.directive('cabeceraconlogin', function () {
        return {
            restrict: 'E',
            templateUrl: '/damelapatita/secciones/cabeceraLogin.html'
        };
    }); // Fin cabeceraconlogin

    /**
    * Sidebar informacion
    */
    app.directive('informacion', function () {
        return {
            restrict: 'E',
            templateUrl: '/damelapatita/secciones/informacion.html'
        };
    }); // Fin informacion

    /**
    * Sección central
    */
    app.directive('central', function () {
        return {
            restrict: 'E',
            templateUrl: '/damelapatita/secciones/central.php'
        };
    });

    /**
    * Sección mapa (dentro de central)
    */
    app.directive('mapa', function () {
        return {
            restrict: 'E',
            templateUrl: '/damelapatita/secciones/googleMaps.php'
        };
    });

    /**
    * Sidebar anuncio
    */
    app.directive('anuncios', function () {
        return {
            restrict: 'E',
            templateUrl: '/damelapatita/secciones/anuncios.php'
        };
    });

    /**
    * Formularios de registro
    */
    app.directive('registro', function () {
        return {
            restrict: 'E',
            templateUrl: '/damelapatita/secciones/registro.php'
        };
    });

    /**
    * Animales en adopcion
    */
    app.directive('adopcion', function () {
        return {
            restrict: 'E',
            templateUrl: '/damelapatita/secciones/adoptables.php'
        };
    });

})(); // Fin función principal
