import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getMessaging, getToken } from "firebase/messaging";

// Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyB6CntNU2aCwUKjcXFDwROvaSdq4KA2B_Y",
  authDomain: "zreq-notification.firebaseapp.com",
  projectId: "zreq-notification",
  storageBucket: "zreq-notification.appspot.com",
  messagingSenderId: "816609022448",
  appId: "1:816609022448:web:316cbeab89d9c64bfd0d35",
  measurementId: "G-KLC5P59HPP"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const messaging = getMessaging(app);

getToken(messaging, { vapidKey: 'BGHOVmPE9dXh-p-cVER5AWXA73nR-kqROeAwcD3rKd_3zkkDsXbL7dpGmBTjsKoM8btnZ0n_gLhl-vFlk95_QTE' })
  .then((currentToken) => {
    if (currentToken) {
      console.log(currentToken);
    } else {
      console.log('No registration token available. Request permission to generate one.');
    }
  })
  .catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
  });
