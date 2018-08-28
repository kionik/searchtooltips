<?
/**
 * @var yk\core\Template $this
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?=$this->getDir()?>/css/style.css">
    <title>Document</title>
</head>
<body>
    <div id="vueApp">
        <input type="text" v-model="search" class="search">
        <div id="search_results">
            <div
                v-for="searchResult of searchResults"
                class="search_result_variant"
                @click="setResult(searchResult)"
            >
                {{ searchResult }}
            </div>
        </div>
    </div>
    <script src="<?=$this->getDir()?>/dist/bundle.js"></script>
</body>
</html>


