<?php 
class ControllerProductReviewsOutside extends Controller {
    
    public function index(){
        
        $this->load->model('catalog/review');
        
        $this->load->language('product/review');
        
        $start = 0;
        
        $limit = 2;
        
        $data['reviews'] = array();
        
        $data['text_empty'] = $this->language->get('text_empty');
        
        $reviews = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], $start, $limit);
        
        if($reviews) {
            
            foreach($reviews as $review) {
                
                $answers = array();
                
                $review_answer = $this->model_catalog_review->getReviewAnswerByProductId($review['review_id'], $start, $limit);
                
                foreach($review_answer as $answer){
                    $answers[] = array(
                        'answer_id' => $answer['answer_id'],
                        'author' => $answer['author'],
                        'text'  => $answer['text'],
                        'date_added' => date('d.m.Y', strtotime($answer['date_added'])),
                        'date_added2' => date('Y-m-d', strtotime($answer['date_added'])),
                    );
                }
                
                $data['reviews'][] = array(
                    'review_id' => $review['review_id'],
                    'scores' => $this->model_catalog_review->getScoreByProduct($this->request->get['product_id'], $review['review_id']),
                    'answers' => $answers,
                    'total_anwers' => $this->model_catalog_review->getTotalReviewsAnswerByProductId($review['review_id']) ? $this->model_catalog_review->getTotalReviewsAnswerByProductId($review['review_id']): 0,
                    'author' => $review['author'],
                    'date_added' => date('d.m.Y', strtotime($review['date_added'])),
                    'date_added2' => date('Y-m-d', strtotime($review['date_added'])),
                    'text' => $review['text'],
                    'rating' => $review['rating'],
                    'likes' => $review['likes'],
                    'dislike' => $review['dislike']
                );
            }   
        } 
        
        if($this->customer->isLogged()){
            $data['name'] = $this->customer->getFirstName();
            $data['email'] = $this->customer->getEmail();
        } else {
            $data['name'] = '';
            $data['email'] = '';
        }
        
        $data['total_reviews'] = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);
                
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/reviews_outside.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/product/reviews_outside.tpl', $data);
        } else {
                return $this->load->view('default/template/product/reviews_outside.tpl', $data);
        }
        
    }
    
    public function tabReviews(){
        
        $this->load->model('catalog/review');
        
        $this->load->language('product/review');
        
        if (isset($this->request->get['page'])) {
                $page = $this->request->get['page'];
        } else {
                $page = 1;
        }

        if (isset($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
        } else {
                $limit = 5;
        }
        
        $start = ($page - 1) * $limit;
        
        $limits = $limit;
        
        $data['reviews'] = array();
        
        $data['text_empty'] = $this->language->get('text_empty');
        
        $reviews = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], $start, $limits);
        
        if($reviews) {
            
            foreach($reviews as $review) {
                
                $answers = array();
                
                $review_answer = $this->model_catalog_review->getReviewAnswerByProductId($review['review_id']);
                
                foreach($review_answer as $answer){
                    $answers[] = array(
                        'answer_id' => $answer['answer_id'],
                        'author' => $answer['author'],
                        'text'  => $answer['text'],
                        'date_added' => date('d.m.Y', strtotime($answer['date_added'])),
                        'date_added2' => date('Y-m-d', strtotime($answer['date_added'])),
                    );
                }
                
                $data['reviews'][] = array(
                    'review_id' => $review['review_id'],
                    'scores' => $this->model_catalog_review->getScoreByProduct($this->request->get['product_id'], $review['review_id']),
                    'answers' => $answers,
                    'total_anwers' => $this->model_catalog_review->getTotalReviewsAnswerByProductId($review['review_id']) ? $this->model_catalog_review->getTotalReviewsAnswerByProductId($review['review_id']): 0,
                    'author' => $review['author'],
                    'date_added' => date('d.m.Y', strtotime($review['date_added'])),
                    'date_added2' => date('Y-m-d', strtotime($review['date_added'])),
                    'text' => $review['text'],
                    'rating' => $review['rating'],
                    'likes' => $review['likes'],
                    'dislike' => $review['dislike']
                );
            }   
        }

        if($this->customer->isLogged()){
            $data['name'] = $this->customer->getFirstName();
            $data['email'] = $this->customer->getEmail();
        } else {
            $data['name'] = '';
            $data['email'] = '';
        }
        
        $total_reviews = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);
       
        if (isset($this->request->get['page'])) {
                $page = $this->request->get['page'];
        } else {
                $page = 1;
        }
        
        $data['totals'] = ceil($total_reviews / $limit);
        
        $data['product_id'] = $this->request->get['product_id'];
                                       
        $pagination = new Pagination();
        $pagination->total = $total_reviews;
        $pagination->page = $page;
        $pagination->limit = $limit;
        $pagination->url = $this->url->link('product/reviews_outside/infoReview', 'product_id=' . $this->request->get['product_id'] . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/tab_reviews.tpl')) {
                return $this->load->view($this->config->get('config_template') . '/template/product/tab_reviews.tpl', $data);
        } else {
                return $this->load->view('default/template/product/tab_reviews.tpl', $data);
        }
        
    }
    
    public function infoReview(){
        $this->response->setOutput($this->tabReviews());
    }
    
    public function likesDislikeReview(){
        
        $json = array();
        
        $this->load->model('catalog/review');
        
        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            
            $metka = $this->request->post['metka'];
            
            switch($metka){
                case 'likes':
                    $likes = 1;
                    $dislike = 0;
                    
                    $sdata = array(
                        'product_id' => $this->request->post['product_id'],
                        'customer_id' => $this->request->post['customer_id'],
                        'review_id' => $this->request->post['review_id'],
                        'likes' => $likes,
                        'dislike' => $dislike
                    );
                    
                    $this->model_catalog_review->addScoreReview($sdata);

                    break;
                case 'dislike':
                    $likes = 0;
                    $dislike = 1;
                    
                    $sdata = array(
                        'product_id' => $this->request->post['product_id'],
                        'customer_id' => $this->request->post['customer_id'],
                        'review_id' => $this->request->post['review_id'],
                        'likes' => $likes,
                        'dislike' => $dislike
                    );
                    
                    $this->model_catalog_review->addScoreReview($sdata);
                    
                    break;
            }
                         
        }
        
        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }
}

?>