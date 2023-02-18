<?php

namespace JsonLd;

class BreadcrumbList implements IGenerate
{

    private $pages = [];

    public function add($id, $name)
    {
        $this->pages[] = [
            "id" => $id,
            "name" => $name
        ];
    }

    public function generate()
    {
        $data = [
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
        ];

        foreach ($this->pages as $i => $page) {
            $node = [
                "@type" => "ListItem",
                "position" => $i + 1,
                "item" => \addHostnameToLink($page["id"]),
                "name" => $page["name"]
            ];

            $data["itemListElement"][] = $node;
        }

        return json_encode($data);
    }
}
