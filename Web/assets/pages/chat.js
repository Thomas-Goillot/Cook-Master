$(document).ready(function () {
  
  var intId = null;
  
  async function displayConversation(idConversation) {
    await fetch("Chat/displayConversation/" + idConversation)
      .then((response) => response.text())
      .then((html) => {
        $("#ConversationChatBox").html(html);

        $("#sendMessage").on("click", async function () {
          let message = $("#message").val();

          await fetch("Chat/sendMessage", {
            method: "POST",
            body: JSON.stringify({
              message: message,
              idConversation: idConversation,
            }),
            headers: {
              "Content-Type": "application/json",
            },
          }).then(() => {
            setTimeout(function () {
              $("#message").val("");
              objDiv = document.getElementById("chatbox");
              objDiv.scrollTop = objDiv.scrollHeight;
            }, 500);
          });
        });
      })
      .then(() => {
        objDiv = document.getElementById("chatbox");
        objDiv.scrollTop = objDiv.scrollHeight;
      })
      .catch((error) => console.error(error));
  }

  async function refreshConversation(idConversation) {
    await fetch("Chat/refreshConversation/" + idConversation)
      .then((response) => response.text())
      .then((html) => $("#chatbox").html(html))
      .catch((error) => console.error(error));
  }

  $(".buttonDisplay").click(async function () {

    if (intId) {
      clearInterval(intId);
    }

    idConversation = $(this).data("idconversation");
    await displayConversation(idConversation);

    intId = setInterval(async function () {
      await refreshConversation(idConversation);
      console.log("refresh" + idConversation);
    }, 500);
  });
});
