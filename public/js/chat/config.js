// MySQL API
var apis = 'chat/api.php'; 

// set image directori
var imageDir = 'images';

// Replace with: your firebase account
var config = {
    apiKey: "AIzaSyBVNa24tHHKj0MvLjTQinOnX7hSY06pkfM",
    databaseURL: "https://fir-web-learn-13b8f.firebaseio.com"
};
firebase.initializeApp(config);

// create firebase child
var dbRef = firebase.database().ref(),
	messageRef = dbRef.child('message'),
	userRef = dbRef.child('user');
