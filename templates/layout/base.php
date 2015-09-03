<!doctype html>

<html lang="en">
    <head>
        <title><?php echo isset($pageTitle) ? $pageTitle : 'The most awesome blog'; ?></title>
        <meta name="description" content="The most awesome blog ever">
        <meta name="author" content="Serkin Alexander">
        <meta charset="utf-8">

        <link rel="stylesheet" href="/css/styles.css?v=1.0">

        <style>
            table {
                width: 100%;
            }
            .header_links_block {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <script src="/js/scripts.js"></script>

        <header>
            <table>
                <tr>
                    <td class="header_links_block">
                        <a href="/newpostform/">new post</a>
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="">
                        <a href="/">My blog</a>
                    </td>
                </tr>
            </table>
        </header>


        <div>
            {content}
        </div>


        <footer>
            <hr>
             github
        </footer>
    </body>
</html>
