<html>
    <body>
        <form method="post" action="/projects">
            @csrf
            <input type="text" name="title">
            <input type="text" name="description">
            <button>确认</button>
        </form>
    </body>
</html>
