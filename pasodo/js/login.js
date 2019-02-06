var app = angular.module("pasodoindex", []);
app.directive("loginForm", function(){
	return {
		restrict : "M",
		replace : true,
		template: "<h3>Welcome<h3>"
	};
});