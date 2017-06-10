<!DOCTYPE html>
<html>
<head>
  <title>Simple Invoicing</title>
  <meta charset='utf-8'>
  <meta name="description" content="AngularJS and Angular Code Example for creating Invoices and Invoicing Application">
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="angular.min.js"></script>
  <script type="text/javascript" src="main.js"></script>
</head>
<body ng-app="invoicing" ng-controller="InvoiceCtrl" >
  <div class="container" width="800px" id="invoice" >
    <div class="row">
      <div class="col-xs-12 heading">
        INVOICE
      </div>
    </div>
    <div class="row branding">
        <div class="col-xs-6 logo-container">
        <input type="file" id="imgInp" />
        <img ng-hide="logoRemoved" id="company_logo" ng-src="{{ logo }}" alt="your image" width="300" />
        <div>
          <div class="noPrint" ng-hide="printMode">
            <a ng-click="editLogo()" href >Edit Logo</a>
            <a ng-click="toggleLogo()" id="remove_logo" href >{{ logoRemoved ? 'Show' : 'Hide' }} logo</a>
          </div>
        </div>
      </div>
      <div class="col-xs-6 invoice-number-container">
        <div class="">
            <label for="invoice-date">Invoice Date</label><input type="date" id="invoice-date" ng-model="invoice.invoice_date" /><br>
          <label for="invoice-number">Invoice #</label><input type="text" id="invoice-number" ng-model="invoice.invoice_number" />
        </div>
      </div>
      
    </div>
    <div class="row infos">
      <div class="col-xs-6">
        <div class="input-container"><input type="text" ng-model="invoice.customer_info.name"/></div>
        <div class="input-container"><input type="text" ng-model="invoice.customer_info.web_link"/></div>
        <div class="input-container"><input type="text" ng-model="invoice.customer_info.address1"/></div>
        <div class="input-container"><input type="text" ng-model="invoice.customer_info.address2"/></div>
        <div class="input-container"><input type="text" ng-model="invoice.customer_info.postal"/></div>
        <div class="input-container" data-ng-hide='printMode'>
          <select ng-model='currencySymbol' ng-options='currency.symbol as currency.name for currency in availableCurrencies'></select>
        </div>
      </div>
      <div class="col-xs-6 right">
        <div class="input-container"><input type="text" ng-model="invoice.company_info.name"/></div>
        <div class="input-container"><input type="text" ng-model="invoice.company_info.web_link"/></div>
        <div class="input-container"><input type="text" ng-model="invoice.company_info.address1"/></div>
        <div class="input-container"><input type="text" ng-model="invoice.company_info.address2"/></div>
        <div class="input-container"><input type="text" ng-model="invoice.company_info.postal"/></div>
      </div>
    </div>
    <div class="items-table">
      <div class="row header">
        <div class="col-xs-1">&nbsp;</div>
        <div class="col-xs-5">Description</div>
        <div class="col-xs-2">Quantity</div>
        <div class="col-xs-2">Cost {{currencySymbol}}</div>
        <div class="col-xs-2 text-right">Total</div>
      </div>
      <div class="row invoice-item" ng-repeat="item in invoice.items" ng-animate="'slide-down'">
        <div class="col-xs-1 remove-item-container">
          <a href ng-hide="printMode" ng-click="removeItem(item)" class="btn btn-danger">[X]</a>
        </div>
        <div class="col-xs-5 input-container">
          <input ng-model="item.description" placeholder="Description" />
        </div>
        <div class="col-xs-2 input-container">
          <input ng-model="item.qty" value="1" size="4" ng-required ng-validate="integer" placeholder="Quantity" />
        </div>
        <div class="col-xs-2 input-container">
          <input ng-model="item.cost" value="0.00" ng-required ng-validate="number" size="6" placeholder="Cost" />
        </div>
        <div class="col-xs-2 text-right input-container">
          {{item.cost * item.qty | currency: currencySymbol}}
        </div>
      </div>
      <div class="row invoice-item">
        <div class="col-xs-12 add-item-container" ng-hide="printMode">
          <a class="btn btn-primary" href ng-click="addItem()" >[+]</a>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-10 text-right">Sub Total</div>
        <div class="col-xs-2 text-right">{{invoiceSubTotal() | currency: currencySymbol}}</div>
      </div>
      <div class="row">
        <div class="col-xs-10 text-right">Tax(%): <input ng-model="invoice.tax" ng-validate="number" style="width:43px"></div>
        <div class="col-xs-2 text-right">{{calculateTax() | currency: currencySymbol}}</div>
      </div>
      <div class="row">
        <div class="col-xs-10 text-right">Grand Total:</div>
        <div class="col-xs-2 text-right">{{calculateGrandTotal() | currency: currencySymbol}}</div>
      </div>
    </div>
    <div class="row noPrint actions">
      <a href="#" class="btn btn-primary" ng-show="printMode" ng-click="printInfo()">Print</a>
      <a href="#" class="btn btn-primary" ng-click="clearLocalStorage()">Reset</a>
      <a href="#" class="btn btn-primary" ng-hide="printMode" ng-click="printMode = true;">Turn On Print Mode</a>
      <a href="#" class="btn btn-primary" ng-show="printMode" ng-click="printMode = false;">Turn Off Print Mode</a>
    </div>
  </div>
</body>
</html>
