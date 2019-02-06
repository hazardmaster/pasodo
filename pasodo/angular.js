var app = angular.module('myApp', []);
    app.directive('hazardMaster', function(){
        return {
            restrict : "M",
            replace : true,
            template: "<h2>This is my son with whom I am pleased</h2>"
            };
        });