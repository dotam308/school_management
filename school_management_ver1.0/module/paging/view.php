<?php
genPaging('manageStudent.php', $_GET, $totalPages);
function genPaging($rootLink, $params, $total_pages)
{

    $pagLink = "<ul class='pagination'>";
    $page = isset($params['page']) ? $params['page'] : 0;
    if ($page > 1) {
        $params['page'] = $page - 1;
        $linkPrev = http_build_query($params);
        $pagLink .= "<li class='page-item'><a class='page-link' href=''>" . 'Prev' . "</a></li>";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $params['page'] = $i;
        $linkPrev = http_build_query($params);
        $pagLink .= "<li class='page-item'><a class='page-link' href='$rootLink?$linkPrev'>" . $i . "</a></li>";
    }
    if ($page < $total_pages) {
        $pagLink .= "<li class='page-item'>
        <a class='page-link' 
                href='$rootLink?type=view&direction=$params[direction]&order=$params[order]&page=" . ($page + 1) . "'>" . 'next' . "
        </a>
    </li>";
    }
    return $pagLink . "</ul>";
}

function regenerate($rootLink, $params, $fields)
{
    $newParams = array_merge($params, $fields);
    $linkPrev = http_build_query($newParams);
    return $rootLink . '?' . $linkPrev;
}
