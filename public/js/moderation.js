var moderation = {

    init: function(){
        reportedComment = document.getElementById("ReportedComment");
        reportedCommentArea = document.getElementById("ReportedCommentArea");
    },

    reportedComment: function(){
        moderation.init();

        reportedComment.addEventListener("click", function(){
            console.log("commentaire signalé");
            reportedCommentArea.textContent = "Ce commentaire a été signalé à l'administrateur.";
        });
    }
}

moderation.reportedComment();