## FXPay

Payment gateway designed with forex in mind. Currently work in progres...

### How does it work?

The system consists of:

MerchantConfig - stores the merchant configuration for the given vendor

HandlerStrategy - describes the strategy of dealing with the vendor

######Request:

PaymentRequest - stores the request parameters, you want to send to the vendor

RequestBuilder - builds the array of parameters, needed to be passed to the vendor

######Response: 

ResponseValidator - validates the response, based on the merchants rules

ResponseBuilder - builds the payment response object, containing information about the transaction, once you got the merchant notification from the vendors system

For the workflow check the [TwoDudes\FXPay\HandlerStrategy\FormWithRedirectStrategy](../../HandlerStrategy/FormWithRedirectStrategy.php)


### I don't want to read, give me a sample

Check the tests

### How to use the event manager?

There is a build in events system. You can use the built in event manager (the simpliest possible),
 or include your own one, if you want

```php
$this->strategy = new FormWithRedirectStrategy($config);
$this->strategy->setEventManager(new EventManager());
```

If you want your custom event manager, just make sure, that it 
implements the TwoDudes\FXPay\Events\EventManagerInterface

##### What event do you have?

Creating Request:

AfterRequestBuildEvent - fires, once the request builder built the params to generate the form. 
Here you can modify the generated params

AfterFormBuildEvent - fires, once the html content with the hidden form was built. Here you can 
modify the form html.

Processing response: 

BeforeProcessResponseEvent - fires before any processing took place.

AfterBuildVendorResponseEvent - fires in the very end, once the VendorResponse is ready.

##### How to attach a new event

```php
$this->strategy->getEventManager()->attach(BeforeProcessResponseEvent::getName(), function(BeforeProcessResponseEvent $event) {
    $params = $event->getParams();
    ...
    do something with the params
    ...
    $event->setParams($params);
});
```


