<?php
require_once 'View.php';

class RecordView extends View {
	private $recordModel;

	public function __construct(RecordController $controller, CoreModel $coreModel, RecordModel $recordModel) {
		parent::__construct ( $controller, $coreModel );
		$this->recordModel = $recordModel;
	}

	public function output() {
		$recordList = $this->recordModel->getRecordList();
		$articlesHtml = "";
		
		$article_template = file_get_contents ( './templates/pages/records/article_template.php' );
		$start = array (
				"{{ recordId }}",
				"{{ header }}",
				"{{ body }}" 
		);
		
		if (isset ( $recordList )) {
			// If the user has records in the database
			
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
			// If no records exist
			
			$no_article_placeholder = file_get_contents ( './templates/pages/records/no_article_placeholder.php' );
			
			$replace = array (
					0,
					"You have no records!",
					"If you did have records, we'd show them here! Start by adding a new record above." 
			);
			
			$articlesHtml .= str_replace ( $start, $replace, $no_article_placeholder );
		}
		
		include_once 'templates/pages/header.php';
		include_once 'templates/pages/records/insert_new_record.php';
		include_once 'templates/pages/records/record_list.php';
		include_once 'templates/pages/footer.php';
	}

}
?>