from scrapy.spiders import BaseSpider
from scrapy.selector import HtmlXPathSelector
from bkstr.items import BkstrItem


class MySpider(BaseSpider):
        name = "book"
        allowed_domains = ["bkstr.com"]
        start_urls = ["http://www.bkstr.com/webapp/wcs/stores/servlet/booklookServlet?bookstore_id-1=584&term_id-1=2016 fall&crn-1=90018"]

        def parse (self, response):
                #hxs = HtmlXPathSelector(response)
                #titles = select.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3')
                #items = []
                var1 = response.xpath('//*[@id="fldset-crsmaterialgrp_1"]/div[1]/h3/text()') 
		#var2 = response.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()')
		#var3 = response.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()')

                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_1"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title1"] = var1.extract()[0].strip()
			yield item
                #yield item
		var11 = response.xpath('//*[@id="materialAuthor"]/text()')
                for sel in response.xpath('//*[@id="materialAuthor"]/text()'):
                        item = BkstrItem()
                        item["author1"] = var11.extract()[0].strip()
                        yield item
		var12 = response.xpath('//*[@id="materialISBN"]')
                for sel in response.xpath('//*[@id="materialISBN"]/text()'):
                        item = BkstrItem()
			item["isbn1"] = var12.extract()[0].strip()
                        yield item
		var13 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price1"] = var13.extract()[0].strip()
                        yield item

                var2 = response.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()')
                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title2"] = var2.extract()[0].strip()
                	yield item
		var21 = response.xpath('//*[@id="materialAuthor"]/text()')
                for sel in response.xpath('//*[@id="materialAuthor"]/text()'):
                        item = BkstrItem()
                        item["author2"] = var21.extract()[0].strip()
                        yield item
		var22 = response.xpath('//*[@id="materialISBN"/text()')
                for sel in response.xpath('//*[@id="materialISBN"]/text()'):
                        item = BkstrItem()
                        item["isbn2"] = var22.extract()[0].strip()
                        yield item
		var23 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price2"] = var23.extract()[0].strip()
                        yield item



                var3 = response.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()')
                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title3"] = var3.extract()[0].strip()
                	yield item
		var31 = response.xpath('//*[@id="materialAuthor"]/text()')
                for sel in response.xpath('//*[@id="materialAuthor"]/text()'):
                        item = BkstrItem()
                        item["author3"] = var31.extract()[0].strip()
                        yield item
		var32 = response.xpath('//*[@id="materialISBN"]/text()')
                for sel in response.xpath('//*[@id="materialISBN"]/text()'):
                        item = BkstrItem()
                        item["isbn3"] = var32.extract()[0].strip()
                        yield item
		var33 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price3"] = var33.extract()[0].strip()
                        yield item




