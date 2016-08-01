
/* Send a notification to the user that a movie is added to their list */
chrome.runtime.onMessage.addListener(function(response, sender, sendResponse){

    var opt = {
      type: "basic",
      title: response.Title,
      message: response.Title + " was added to your recommendation engine",
      iconUrl: "icon.png",
    }
    chrome.notifications.create("", opt, function(){});

})
