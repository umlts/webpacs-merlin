<?

require_once('IIIParse.php');

class SiteParse extends IIIParse {

    public $catalog_url = "http://example.library.edu";
    public $base_url = "http://m.example.library.edu/";

    public $method_type = "mobileinfo";
    #public $method_type = "scrape";

    public $catalog_name = "Catalog";

    public $email_from = "library@example.edu";
    public $feedback_email = "feedback@example.edu";

    public $cover_image_type = "syndetics";
    #public $cover_image_type = "openlibrary";
    #public $cover_image_type = "contentcafe";
    #public $cover_image_type = "googlebooks";
    
    public $cover_userid = "";
    public $cover_pass = "";

    public $email_subject_prefix = "Library";

    # to enable scoping, set this to 1
    public $scoping = 0;

    # define scopes within here
    public $scopes = array(
        # copy the following line (without the leading '#') for each scope your catalog uses, replacing [NAME] and [VALUE] with each associated scope
        #   array("name" => "[NAME]", "value" => "[VALUE]"),
        #
        # example:
        #   array("name" => "Reference", "value" => "1"),
        #   array("name" => "Books", "value" => "2"),
        #   .. etc

   ); 
   # end scopes

}
?>
