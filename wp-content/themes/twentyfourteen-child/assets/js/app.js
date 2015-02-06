function WpRestController($scope, $http) {

            $scope.viewList = true;

            $scope.getOnePost = function(id) {
                $http({
                    method : 'GET',
                    url : '/wp-json/posts/' + id
                })
                .success(function(data, status) {
                    $scope.oneTitle = data.title;
                    $scope.oneContent = data.content;
                    $scope.viewList = false;
                })
                .error(function(data, status) {
                    console.dir(status);
                });
            }
            
            $scope.backToList = function() {
                $scope.viewList = true;
            }
            
            $scope.getItems = function() {

                $http({
                    method : 'GET',
                    url : '/?json=1'
                })
                .success(function(data, status) {
                    $scope.data = data;
                })
                .error(function(data, status) {
                    console.dir(status);
                });
            }

        }

        angular.module('app', [])
            .controller('WpRestController', WpRestController)
            .filter('unsafe', function($sce) { return $sce.trustAsHtml; });

