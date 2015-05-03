<?php
require_once 'View.php';

class HomeView extends View {
	private $recordModel;

	public function __construct(HomeController $controller, CoreModel $coreModel, RecordModel $recordModel) {
		parent::__construct ( $controller, $coreModel );
		$this->recordModel = $recordModel;
	}

	public function output() {
		$recordList = $this->recordModel->recordList;
		$articlesHtml = "";
		
		$article_template = file_get_contents ( './templates/pages/home/article_template.php' );
		$start = array (
				"{{ recordId }}",
				"{{ header }}",
				"{{ body }}" 
		);
		
		if (isset ( $recordList )) {
			
			foreach ( $recordList as $record ) {
				
				$recordId = $record ['record_id'];
				$recordTime = new DateTime ( $record ['timestamp'] );
				$recordText = $record ['text'];
				
				$replace = array (
						$recordId,
						date_format ( $recordTime, 'Y-m-d H:i' ),
						$recordText 
				);
				
				$articlesHtml .= str_replace ( $start, $replace, $article_template );
			}
		} else {
			
			// TODO should this be done in the controller? @alanhave
			
			$replace = array (
					0,
					date ( 'Y-m-d H:i' ),
					"Emailed the landlord today about the water leak above the apartment. This is an example record that will dissapear after creating a new record." 
			);
			
			$articlesHtml .= str_replace ( $start, $replace, $article_template );
		}
		
		include_once 'templates/pages/header.php';
		include_once 'templates/pages/home/insert_new_record.php';
		include_once 'templates/pages/home/record_list.php';
		include_once 'templates/pages/footer.php';
	}

}
?>