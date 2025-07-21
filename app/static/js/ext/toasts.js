function toastifyErrors(errors) {
    return errors.map((err) => {
        err.level = 'error';
        return err;
    });
}

function showToast(messages) {
    window.toasted = window.toasted || false;
    onDocReady(() => {
        if (!window.toasted) {
            const stack = getStack('toasts');
            stack.addToastMessage(messages);
            window.toasted = true;
            setTimeout(() => {
                window.toasted = false;
            }, 1000);
        }
    })
}

function toast(count) {
    return {
        toastsClass: '',
        previousToastUid: null,
        toastMessages: [
            // {
            //   id: 'some_id',
            //   level: 'warning', // error, warning, info, success
            //   title: 'Optional title',
            //   message: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. ',
            //   uid: Math.floor(Math.random() * (1e9-100 + 1)) + 100
            // },
        ],
        removeToastMessage(uid) {
            try {
                $(`#toast-${uid}`).classList.add('toast-leave-to');
            } catch (er) { }
            setTimeout(() => {
                this.toastMessages = this.toastMessages.filter((m) => m.uid !== uid);
            }, 100);
        },

        fadeToast(uid, timeout = 5000) {
            const timer = setTimeout(() => {
                try {
                    $(`#toast-${uid}`).classList.add('toast-leave-to');
                } catch (er) { }
                setTimeout(() => {
                    this.toastMessages = this.toastMessages.filter((m) => m.uid !== uid);
                }, 100);
            }, timeout);

            this.$nextTick(() => {
                if ($(`#toast-${uid}`)) {
                    $(`#toast-${uid}`).addEventListener('mouseenter', () => {
                        clearTimeout(timer);
                        $(`#toast-${uid}`).addEventListener('mouseleave', () => {
                            this.fadeToast(uid, 2000);
                        });
                    });
                }
            })
        },

        addToastMessage(messages) {
            if (!Array.isArray(messages)) {
                messages = [messages];
            }

            /**
             * Message example:
             * {
             *  id: 'NOT_FOUND',
             *  level: 'info', // error, warning, info, success (defaults to "info")
             *  title: 'Optional title',
             *  message: 'Entity not found'
             * }
             */
            messages.map(msg => {
                const uid = Math.floor(Math.random() * (1e9 - 100 + 1)) + 100;
                msg.uid = uid;
                msg.title = msg.title || '';
                msg.level = (msg.level || 'info').toLowerCase();

                // enter transition
                this.toastsClass = 'entering';
                if (this.previousToastUid) {
                    try {
                        $(`#toast-${this.previousToastUid}`).classList.add('entering');
                        setTimeout(() => {
                            try {
                                $(`#toast-${this.previousToastUid}`).classList.remove('entering');
                            } catch (er) { }
                        }, 200);
                    } catch (er) { }
                }
                this.toastMessages.unshift(msg);

                setTimeout(() => {
                    this.toastsClass = '';
                }, 10);

                // leave transition
                // setTimeout(() => {
                //   try {
                //     $(`#toast-${uid}`).classList.add('toast-leave-to');
                //   } catch (er) { }
                //   setTimeout(() => {
                //     this.toastMessages = this.toastMessages.filter((m) => m.uid !== uid);
                //   }, 100);
                // }, 5000);
                this.fadeToast(uid);

                this.previousToastUid = uid;
            });
        }
    };
}
