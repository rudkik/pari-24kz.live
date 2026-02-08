@extends('main')
@section('title', 'История транзакций')
@section('content')
    <main class="main">
        <div class="_container p-wrap-aside">
            <section class="sport">
                <h3 class="history-title">История транзакций</h3>
                <table class="transaction-table">
                    <thead class="table-header">
                    <tr>
                        <th>ID</th>
                        <th>Дата и время</th>
                        <th>Тип транзакции</th>
                        <th>Платёжная система</th>
                        <th>Статус заявки</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="editable-row" id="editableRow">
                        <td contenteditable="true" data-field="id">000000001</td>
                        <td contenteditable="true" data-field="date">{{ date('d.m.Y H:i') }}</td>
                        <td contenteditable="true" data-field="type">Пополнение</td>
                        <td contenteditable="true" data-field="payment">
                            <div class="two-lines">Visa/Mastercard<br>•••• 1234</div>
                        </td>
                        <td contenteditable="true" data-field="status">
                            <div class="two-lines">В обработке<br>ожидание</div>
                        </td>
                        <td contenteditable="true" data-field="amount">1000
                            @if (Auth::check())
                                @if (auth()->user()->cur == 'RUB') ₽
                                @else ₸
                                @endif
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
                
                <div class="pagination">
                    <span class="pagination__link disabled">&lt;</span>
                    <span class="pagination__current">1</span>
                    <span class="pagination__link disabled">&gt;</span>
                </div>
            </section>
        </div>
    </main>
    
    <style>
        .history-title {
            margin-bottom: 25px;
            font-size: 1.5rem;
            color: #fff;
        }
        
        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #333;
            color: #fff;
            font-size: 1rem;
        }
        
        .transaction-table th {
            background-color: #444;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #555;
        }
        
        .transaction-table td {
            padding: 15px;
            border-bottom: 1px solid #555;
            vertical-align: middle;
        }
        
        .editable-row td {
            background-color: #433f3f;
            border: 1px dashed #666;
        }
        
        .editable-row td:focus {
            outline: 2px solid #4CAF50;
            background-color: #555 !important;
            color: #fff;
        }
        
        [contenteditable="true"]:focus {
            background-color: #555 !important;
            color: #fff !important;
        }
        
        .two-lines {
            line-height: 1.4;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
            gap: 15px;
        }
        
        .pagination__link {
            padding: 10px 18px;
            border: 1px solid #666;
            border-radius: 5px;
            text-decoration: none;
            color: #ccc;
            cursor: pointer;
            background-color: #444;
            transition: all 0.3s;
        }
        
        .pagination__link.disabled {
            color: #777;
            cursor: not-allowed;
            border-color: #555;
            background-color: #333;
        }
        
        .pagination__link:hover:not(.disabled) {
            background-color: #555;
            color: #fff;
        }
        
        .pagination__current {
            padding: 10px 18px;
            font-weight: bold;
            color: #4CAF50;
            background-color: #333;
            border-radius: 5px;
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editableRow = document.getElementById('editableRow');
            const cells = editableRow.querySelectorAll('[contenteditable="true"]');
            
            const originalValues = {};
            cells.forEach(cell => {
                if (cell.querySelector('.two-lines')) {
                    originalValues[cell.getAttribute('data-field')] = cell.innerHTML;
                } else {
                    originalValues[cell.getAttribute('data-field')] = cell.textContent.trim();
                }
            });
            
            cells.forEach(cell => {
                cell.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        this.blur();
                        
                        const fieldName = this.getAttribute('data-field');
                        console.log(`Поле "${fieldName}" изменено на:`, this.textContent.trim());
                    }
                });
                
                cell.addEventListener('blur', function() {
                    if (this.textContent.trim() === '') {
                        const fieldName = this.getAttribute('data-field');
                        if (this.querySelector('.two-lines')) {
                            this.innerHTML = originalValues[fieldName];
                        } else {
                            this.textContent = originalValues[fieldName];
                        }
                    }
                });
                
                cell.addEventListener('focus', function() {
                    this.style.backgroundColor = '#555';
                    this.style.color = '#fff';
                });
                
                cell.addEventListener('blur', function() {
                    this.style.backgroundColor = '#433f3f';
                });
            });
        });
    </script>
@endsection