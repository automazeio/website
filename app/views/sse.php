<?php tiny::layout()->default(title: 'SSE', emptyLayout: true, robots: 'noindex, follow'); ?>


<code id="results"></code>
<hr>
<button onclick="window.location.reload();">Retry</button>

<button onclick="window.sseClient['KEY'].close();">Close SSE</button>

<button onclick="connect();">Connect</button>
<script>
    function sseInit(url, cb, id = 'default') {
        window.sseClient = window.sseClient || {};
        window.sseClient[id] = new EventSource(url, {
            withCredentials: true
        });
        window.sseClient[id].addEventListener('message', (e) => {
            if (e.data === "[CLOSE]") {
                window.sseClient[id].close();
            } else {
                cb(JSON.parse(e.data));
            }
        });
        window.sseClient[id].addEventListener('error', (e) => {
            console.error(e);
        });
    }

    function connect() {
        sseInit('?sse=true', (data) => {
            if (data == '[done]') {
                console.log('Done!');
                window.sseClient['user'].close();
                return;
            }
            document.getElementById("results").innerHTML = JSON.stringify(data);
            console.log(data);
        }, 'KEY');
    }
</script>


<?php tiny::layout()->default('/'); ?>
