class Book {
    public $title;
    public $author;
    public $pages;
    public $price;
    public $isbn;
    public function __construct($title, $author, $pages, $price, $isbn) {
        $this->title = $title;
        $this->author = $author;
        $this->pages = $pages;
        $this->price = $price;
        $this->isbn = $isbn;
    }
}