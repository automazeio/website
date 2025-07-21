function notificationWidget() {
  return {
    showing: false,
    update() {
      this.showing = document.querySelectorAll('.notification-center').length > 0
    },
    open() {
      Notifuse.open();
      this.showing = true;
    },
    close() {
      Notifuse.close();
      this.showing = false;
    },
    toggle() {
      document.querySelectorAll('.notification-center').length == 0 ? Notifuse.open() : Notifuse.close();
    }
  };
}


(function(d, s, id){
  const el = document.getElementById(id);
  if (el) el.remove();

  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)){ return; }
  js = d.createElement(s); js.id = id;
  js.onload = function(){
    Notifuse.init({
      ...window.notificationWidgetSettings,
      onClickMessage: (message) => {
        // console.log('got click on message', message);
        switch (message.notificationId) {
          default:
            if (message.data.link) {
              window.open(message.data.link.url, message.data.link.target || '_self');
            }
        }
      },
      bellSelector: '#notification-bell',
      faviconSelector: '#favicon',
      styles: {
        container: {
          fontFamily: 'Inter,Arial,sans-serif',
          fontStyle: 'normal',
        },
        link: {
          color: '#8b78eb',
        },
      },
      classNames: {
        container: 'notification-center',
      },
    });
  };
  js.src = "https://notifuse.com/widget/widget2.min.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'notifuse-jssdk'));
