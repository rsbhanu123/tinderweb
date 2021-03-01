<?php
?>

<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src = "tinderApp.js"></script>
</head>
<body>

<div ng-app="tinderApp" ng-controller="myCtrl">
 
    <div class="jumbotron text-center">
        <h1>Welcome to Tinder</h1>
        <p>Meet your dream partner!</p>
      </div>
      
      <div class="container">
        <div class="row">
          <div class="col-sm-2">          
            <div ng-if=" !isLogin">
            <h3>Login</h3>       
                <p ng-if="isLoginError">{{loginErrorMsg}}</p>   
                <form name="myForm">
                    <input placeholder="username" name="username" required type="text"  ng-model="username" />
                    <input placeholder="password" type="password" required name="password" ng-model="password" />
                    <input type="button"  value="Login" ng-disabled="myForm.username.$invalid || myForm.password.$invalid " ng-click="checkLogin(username,password)"/>
                </form>                
            </div>
          </div>
          <div class="col-sm-6">
            <div ng-if="isLogin">
                <h3>Hello, {{member.firstName}} Select Partner</h3>
                <div class="panel-group" ng-if="memberList.length != 0 && memberList.length != profileIndex">
                    <div class="panel panel-default">
                      <div class="panel-body">                         
                          <div><img src="img/{{memberList[profileIndex].image}}" sizes="100%"></div>
                          <div>Name : {{ memberList[profileIndex].firstName }} {{ memberList[profileIndex].lastName }}({{memberList[profileIndex].age}})</div>
                          <div>Location : {{ memberList[profileIndex].city.name }} {{ memberList[profileIndex].city.state.name }} ,{{ memberList[profileIndex].city.state.country.name }}</div>
                          <div>Hobbies : {{ memberList[profileIndex].hobbies }}</div>
                          <div>Description : {{ memberList[profileIndex].description }}</div>
                      </div>
                    </div>
                    <div class="panel panel-default">                        
                        <button type="button" class="btn btn-outline-dark" aria-label="Left Align" ng-click="onSwipe(profileIndex,2)">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true" n>Left</span>
                        </button>
                        <button type="button" class="btn btn-outline-dark" aria-label="Left Align" ng-click="onSwipe(profileIndex,1)">
                            <span class="gglyphicon glyphicon-heart-empty" aria-hidden="true">Right</span>
                        </button>
                        <button type="button" class="btn btn-outline-dark" aria-label="Left Align" ng-click="shwResult()">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true" n>Done</span>
                        </button>    
                    </div>                    
                  </div>
                  <div class="panel-group" ng-if="memberList.length != 0 && memberList.length == profileIndex">
                    No More Profile
                    <button type="button" class="btn btn-outline-dark" aria-label="Left Align" ng-click="shwResult()">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true" n>Done</span>
                    </button>    
                  </div>
                  <div class="panel-group" ng-if="memberList.length == 0">
                    No More Profile
                    <button type="button" class="btn btn-outline-dark" aria-label="Left Align" ng-click="shwResult()">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true" n>Done</span>
                    </button>    
                  </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="panel-group" ng-if="showResult">
                <h3>Hello, {{member.firstName}} </h3>
                <div class="panel panel-default">
                  <div class="panel-body">                                               
                      <div>Name : {{ member.firstName }} {{ member.lastName }}({{member.age}})</div>
                      <div>Location : {{ member.city.name }} {{ member.city.state.name }} ,{{ member.city.state.country.name }}</div>
                      <div>Hobbies : {{ member.hobbies }}</div>
                      <div>Description : {{ member.description }}</div>
                      <div>Right Swipe : {{ rightCount }}</div>
                      <div>Left Swipe : {{ leftCount }}</div>
                  </div>
                </div>                
          </div>
        </div>
      </div>

</div>

</body>
</html>
