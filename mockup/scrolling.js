<script>
    $(document).ready(function (){
    $(document).rules.on('click', 'a', function(event){
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $( $.attr(this, 'href') ).offset().top
        }, 800);
    });
})
    </script>
