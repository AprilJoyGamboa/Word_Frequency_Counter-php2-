<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Word Frequency Counter</h1>
    <button onclick="goBack()">Go Back</button>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <?php 
    $txt = $_POST["text"];
    $limit = $_POST["limit"];
    $sort = $_POST["sort"];

    // removes punctuation and returns array of words
    function removePunctuation(string $txt){
        $punctuations = " .,!?;:-()[]{}\"'/\\|&#@–\n";
        $words = [];
        $txt = preg_replace('/\n/', ' ', $txt);
        $token = strtok($txt, $punctuations);
        while ($token !== false)
        {
        array_push($words, $token);
        $token = strtok($punctuations);
        }

        foreach ($words as $i){
            $i = strtolower($i);
        }

        return $words;
    }


    // removes common words and other invalid texts
    function removeCommonWords(array $strArr){
        $common_words = ["i", "the", "a", "is", "this", "an", "and", "at", "but", "if"
        ,"in", "it", "of", "on", "or", "to", "with", "as", "s"];
        $empty_string = [" ","\n", ""];
        $alphabet = range('a', 'z');
    
        //remove common words
        while (true) {
            $commonElements = array_intersect($strArr, $common_words);
            
            if (empty($commonElements)) {
                break;
            }
        
            foreach ($commonElements as $value) {
                $index = array_search($value, $strArr);
                if ($index !== false) {
                    unset($strArr[$index]);
                }
            }
        }

        //remove empty string
        while (true) {
            $commonElements = array_intersect($strArr, $empty_string);
            
            if (empty($commonElements)) {
                break;
            }
        
            foreach ($commonElements as $value) {
                $index = array_search($value, $strArr);
                if ($index !== false) {
                    echo "remove ".$str[$index];
                    unset($strArr[$index]);
                }
            }
        }       
            
        return $strArr;
    }

    function textToArray(string $words){
        $words_array = removePunctuation($words);
        $words_array = removeCommonWords($words_array);

        return $words_array;
    }

    // returns the array of words associated with its frequency
    function countWords($wordsArray) {
        $wordCounts = [];

        foreach ($wordsArray as $word) {
            if (isset($wordCounts[$word])) {
                $wordCounts[$word]++;
            } else {
                $wordCounts[$word] = 1;
            }
        }     
        $resultArray = array(); 
        foreach ($wordCounts as $word => $count) {
            $resultArray[] = array('word' => $word, 'count' => $count);
        }
    
        return $resultArray;
    }

    $arr = countWords(textToArray($txt));

    // Sorting the array by the frequency
    function sortByCount($a, $b) {
        return $b['count'] - $a['count'];
    }

    usort($arr, 'sortByCount'); 

    // Display the table
    echo "<table>";
    echo "<tr><th>index</th><th>word</th><th>frequency</th>";

    if (count($arr)<$limit){
        $limit = count($arr);
    }
    
    if ($sort == 'asc'){
        for ($i = count($arr)-1; $i >= count($arr)-$limit; $i--) {
            $index = count($arr)-$i;
            echo "<tr>"."<td>$index</td>"."<td>".$arr[$i]["word"]."</td>"."<td>".$arr[$i]["count"]."</td>"."</tr>";
           }
    }
    elseif($sort == 'desc'){
        for ($i = 0; $i < $limit; $i++) {
            $index = $i+1;
            echo "<tr>"."<td>$index</td>"."<td style = 'text-align:left;'>".$arr[$i]["word"]."</td>"."<td>".$arr[$i]["count"]."</td>"."</tr>";
           }
    
    }
    echo "</table>";
?>

    </form>
</body>
</html>
