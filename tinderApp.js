var tinderApp = angular.module("tinderApp", []);

tinderApp.controller("myCtrl", function($scope,$http) {
    $scope.server ="https://testtinderapp.herokuapp.com";
    $scope.successCode = "11";
    $scope.errorCode = "00";

    $scope.member = {};
    $scope.isLogin = false;
    $scope.isLoginError = false;
    $scope.loginErrorMsg = "";
    $scope.username = '';
    $scope.password = '';
    $scope.memberList = [];
    $scope.profileIndex = 0;
    $scope.showResult = false;
    $scope.rightCount = 0;
    $scope.leftCount = 0;

  $scope.checkLogin = function(username,password){
      
      var requestBody ={
        "emailId":username,
        "password":password
      };
      $scope.isLoginError = false;
      $scope.loginErrorMsg = "";
      $scope.showResult = false;
    $http({
        method : "POST",
        url : "http://"+$scope.server+"/MemberLogin",
        data: JSON.stringify(requestBody)
      }).then(function mySuccess(response) {
          if(response.data.code == $scope.successCode){
            $scope.member = response.data.data;
            console.log("member",$scope.member);
            $scope.isLogin = true;

            $http({
                method : "GET",
                url : "http://"+$scope.server+"/MemberForUser/"+$scope.member.memberId,               
              }).then(function mySuccess(response1) {                  
                $scope.memberList = response1.data.data;
                console.log($scope.memberList);
              }, function myError(response1) {
                
              });
          }else{
            $scope.isLoginError = true;
            $scope.loginErrorMsg =response.data.msg;
          }
        console.log(response);
      }, function myError(response) {
        $scope.isLoginError = true;
        $scope.loginErrorMsg ="Error!";
      });

  }


$scope.onSwipe = function(index1,swipeSide){
    $scope.showResult = false;
    $http({
        method : "POST",
        url : "http://"+$scope.server+"/Member/"+$scope.member.memberId+"/Match/"+$scope.memberList[index1].memberId+"/"+swipeSide,        
      }).then(function mySuccess(response2) {
        if(response2.data.code == "11")
            $scope.profileIndex= $scope.profileIndex +1;
      }, function myError(response) {
        $scope.isLoginError = true;
        $scope.loginErrorMsg ="Error!";
      });
}

$scope.shwResult =function(){  
    $scope.showResult = false;
    $http({
        method : "GET",
        url : "http://"+$scope.server+"/Member/"+$scope.member.memberId+"/matchCount",               
      }).then(function mySuccess(response11) {      
        if(response11.data.code == "11")  {
         $scope.rightCount =response11.data.data.Right;
         $scope.leftCount =response11.data.data.Left;
         console.log(response11.data); 
            $scope.showResult = true;
        }
        else{
            alert("!Error");
        }
       
      }, function myError(response1) {
        
      });    
}

});