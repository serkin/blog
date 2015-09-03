<!doctype html>

<html lang="en">
    <head>
        <title><?php echo isset($pageTitle) ? $pageTitle : 'The most awesome blog'; ?></title>
        <meta name="description" content="The most awesome blog ever">
        <meta name="author" content="Serkin Alexander">
        <meta charset="utf-8">

        <style>
            table {
                width: 100%;
            }
            .header_links_block {
                text-align: right;
            }
            .post_block_date {
                font-size: small;
            }
            .post_block_user {
                text-decoration: underline;
            }
            .post_block_text {
                line-height: 0.7cm;
            }
        </style>
    </head>

    <body>

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
             <a href="https://github.com/serkin/blog" target="_blank">github</a>
        </footer>
    </body>
</html>
