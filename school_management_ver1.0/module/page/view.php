<?php
function getPagination($rootLink, $params, $total){
    $total_pages = ceil($total/ 10);
    $pagLink = "<ul class='pagination'>";
    $page = isset($params['page']) ? $params['page'] : 0;
    $elements = [];
    foreach ($params as $key=>$value) {
        if ($key == 'page' || empty($value)) {
            continue;
        }
        $elements[$key] = $value;
    }
    $linkRef = http_build_query($elements);
//    echo $linkRef;
    if ($page > 1) {
        $pagLink .= "<li class='page-item'>
        <a class='page-link'
           href='$rootLink?$linkRef&page=".($page - 1)."'>".'prev'."
        </a>
    </li>";
    }
    for ($i=1; $i<=$total_pages; $i++) {

        $pagLink .= "<li class='page-item'>";
        if (isset($_GET['page']) && $_GET['page'] == $i) {
            $pagLink .= "<a class='page-link active' href='$rootLink?$linkRef&page=".$i."'>".$i."</a>";
        } else {
            $pagLink .= "<a class='page-link' href='$rootLink?$linkRef&page=".$i."'>".$i."</a>";
        }
        $pagLink .= "</li>";
    }
    if ($page < $total_pages) {

        $pagLink .= "<li class='page-item'>
        <a class='page-link'
           href='$rootLink?$linkRef&page=".($page + 1)."'>".'next'."
        </a>
    </li>";
    }
    echo $pagLink . "</ul>";
}