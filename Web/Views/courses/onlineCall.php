<div class="card">
    <div class="card-body">
        <h4 class="card-title">Cours en ligne</h4>

        <div id="meet"></div>

    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://meet.jit.si/external_api.js"></script>

<script>
    $(document).ready(function() {
        var domain = "meet.jit.si";
        var options = {
            roomName: 'Cours en ligne n<?= $course['id_courses'] ?>',
            parentNode: document.querySelector('#meet'),
            width: "100em",
            height: "50em",
            userInfo: {
                displayName: "<?= ucfirst($user['name']) ?> <?= ucfirst($user['surname']) ?>"
            },
        }
        var api = new JitsiMeetExternalAPI(domain, options);

        api.addEventListener('videoConferenceJoined', function() {

            api.executeCommand('subject', 'Cours test');

            api.executeCommand('displayName', '<?= ucfirst($user['name']) ?> <?= ucfirst($user['surname']) ?>');
        });


    });
</script>