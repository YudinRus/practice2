<?php

// Класс для генерации постраничной навигации

class Pagination {
    
    /*
     *  @var Ссылок навигации на страницу
     */
    
    private $max = 10;
    
    /*
     *  @var Ключ для GET, в который пишется номер страницы 
     */
    
    private $index = 'page';
    
    /*
     *  @var Текущая страница
     */
    
    private $current_page;
    
    /*
     *  @var Общее количество записей
     */
    
    private $total;
    
    /*
     *  @var Записей на страницу
     */
    
    private $limit;
    
    /**
     *  Запуск необходимых данных для навигации
     *  @param integer $total - общее количество записей
     *  @param integer $limit - количество записей на страницу
     * 
     * @return 
     */
    public function __construct($total, $currentPage, $limit, $index) {
        
        # Устанавливаем общее количество записей
        $this->total = $total;
        
        # Устанавливаем количество записей на страницу
        $this->limit = $limit;
        
        # Устанавливаем ключ в url
        $this->index = $index;
        
        # Устанавливаем количество страниц
        $this->amount = $this->amount();
        
        #  Устанавливаем номер текущей страницы
        $this->setCurrentPage($currentPage);
    }
}
