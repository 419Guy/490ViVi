from scrapy.spider import BaseSpider
from scrapy.contrib.linkextractors import LinkExtractor
from scrapy.contrib.spiders import CrawlSpider, Rule
from scrapy.utils.markup import remove_tags
from scrapy.selector import Selector
from scrapy.selector import HtmlXPathSelector
from bkstr.items import BkstrItem
from scrapy.http import Request
from scrapy.loader.processors import Join
import csv
import sys


class MySpider(CrawlSpider):
        name = "book"
	#l = []
        my_file = open("callnumberedited3.csv", "rb")
	reader = csv.reader(my_file)
        #delimiter =  ","
	#for row in reader:
        	#append(row)
	#yield row
    	#print l[0]
	#allowed_domains = my_file#Perhaps the lack of this was causing the excess search
    	start_urls = my_file
	custom_settings = {'REDIRECT_ENABLED': False}
	handle_httpstatus_list = [301]
    	download_delay = 0.25
    	rules = [Rule(LinkExtractor(), follow=True, callback='parse_item')]


	#def start_requests(self):#An attempt at stopping the redirects
	#	for url in self.start_urls:
	#		yield Request(url, meta={'dont_redirect':True})
        
	def parse_item (self, response):
                #hxs = HtmlXPathSelector(response)
                #titles = select.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3')
                items = []
		varx = response.xpath('//*[@id="fldset-course_1_1"]/div[2]/h2/text()')
                for sel in response.xpath('//*[@id="fldset-course_1_1"]/div[2]/h2/text()'):
                        item = BkstrItem()
                        item["course"] = varx.extract()[0]#.strip()
                        yield item

                var1 = response.xpath('//*[@id="fldset-crsmaterialgrp_1"]/div[1]/h3/text()') 
                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_1"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title1"] = var1.extract()[0]#.strip()
			yield item
                #yield item
		var11 = response.xpath('//*[@id="materialAuthor"]/text()')
                for sel in response.xpath('//*[@id="materialAuthor"]/text()'):
                        item = BkstrItem()
                        item["author1"] = var11.extract()#.strip() 
			#item["author2"] = var11.extract()[1].strip()
			yield item
		#var11b = response.xpath('//*[@id="materialAuthor"]/text()')
                #for sel in response.xpath('//*[@id="materialAuthor"]/text()'):
                 #       item = BkstrItem()
                  #      #item["author1"] = var11.extract()[0].strip()
		#	item["author2"] = var11b.extract()[1].strip()
		#	yield item
		var12 = response.xpath('//*[@id="materialISBN"]/text()')
                for sel in response.xpath('//*[@id="materialISBN"]/text()'):
                        item = BkstrItem()
			item["isbn1"] = var12.extract()#.strip() 
			#item["isbn2"] = var12.extract()[1].strip()
                        yield item
		#var12b = response.xpath('//*[@id="materialISBN"]/text()')
                #for sel in response.xpath('//*[@id="materialISBN"]/text()'):
                 #       item = BkstrItem()
			#item["isbn1"] = var12.extract()[0].strip() 
		
		#	item["isbn2"] = var12b.extract()[1].strip() 
                 #       yield item
		var15 = response.xpath('//*[@id="materialCopyrightYear"]/text()')
                for sel in response.xpath('//*[@id="materialCopyrightYear"]/text()'):
                        item = BkstrItem()
                        item["year1"] = var15.extract()#.strip() 
			#item["year2"] = var15.extract()[1].strip()
                        yield item
		#var15b = response.xpath('//*[@id="materialCopyrightYear"]/text()')
                #for sel in response.xpath('//*[@id="materialCopyrightYear"]/text()'):
                 #       item = BkstrItem()
                  #      #item["year1"] = var15.extract()[0].strip()
		#	item["year2"] = var15b.extract()[1].strip() 
                 #       yield item
		var16 = response.xpath('//*[@id="materialPublisher"]/text()')
                for sel in response.xpath('//*[@id="materialPublisher"]/text()'):
                        item = BkstrItem()
                        item["publisher1"] = var16.extract()#.strip() 
			#item["publisher2"] = var16.extract()[1].strip()                        
			yield item	
		#var16b = response.xpath('//*[@id="materialPublisher"]/strong/text()')
                #for sel in response.xpath('//*[@id="materialPublisher"]/strong/text()'):
                 #       item = BkstrItem()
                  #      #item["publisher1"] = var16.extract()[0].strip()
		#	item["publisher2"] = var16b.extract()[1].strip()                         
		#	yield item


                var2 = response.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()')
                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_2"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title2"] = var2.extract()[0]#.strip() 
                	yield item


                var3 = response.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()')
                for sel in response.xpath('//*[@id="fldset-crsmaterialgrp_3"]/div[1]/h3/text()'):
                        item = BkstrItem()
                        item["title3"] = var3.extract()[0]#.strip()
                	yield item

		t1 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[2]/text()'):
                        item = BkstrItem()
                        item["type1a"] = t1.extract()[0]#.strip()
                        yield item
		t2 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[2]/text()'):
                        item = BkstrItem()
                        item["type1b"] = t2.extract()[0]#.strip()
                        yield item
		t3 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[2]/text()'):
                        item = BkstrItem()
                        item["type1c"] = t3.extract()[0]#.strip()
                        yield item
		t4 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[2]/text()'):
                        item = BkstrItem()
                        item["type1d"] = t4.extract()[0]#.strip()
                        yield item
		t5 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[2]/text()'):
                        item = BkstrItem()
                        item["type1e"] = t5.extract()[0]#.strip()
                        yield item		
		t6 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent1a"] = t6.extract()[0]#.strip()
                        yield item
		t7 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent1b"] = t7.extract()[0]#.strip()
                        yield item
		t8 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent1c"] = t8.extract()[0]#.strip()
                        yield item
		t9 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent1d"] = t9.extract()[0]#.strip()
                        yield item
		t10 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent1e"] = t10.extract()[0]#.strip()
                        yield item
		t11 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[4]/text()'):
                        item = BkstrItem()
                        item["option1a"] = t11.extract()[0]#.strip()
                        yield item
		t12 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[4]/text()'):
                        item = BkstrItem()
                        item["option1b"] = t12.extract()[0]#.strip()
                        yield item
		t13 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[4]/text()'):
                        item = BkstrItem()
                        item["option1c"] = t13.extract()[0]#.strip()
                        yield item
		t14 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[4]/text()'):
                        item = BkstrItem()
                        item["option1d"] = t14.extract()[0]#.strip()
                        yield item
		t15 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[4]/text()'):
                        item = BkstrItem()
                        item["option1e"] = t15.extract()[0]#.strip()
                        yield item
		t16 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price1a"] = t16.extract()[0]#.strip()
                        yield item
		t17 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[3]/td[8]/text()'):
                        item = BkstrItem()
                        item["price1b"] = t17.extract()[0]#.strip()
                        yield item
		t18 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[4]/td[8]/text()'):
                        item = BkstrItem()
                        item["price1c"] = t18.extract()[0]#.strip()
                        yield item
		t19 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[5]/td[8]/text()'):
                        item = BkstrItem()
                        item["price1d"] = t19.extract()[0]#.strip()
                        yield item
		t20 = response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_1"]/div[2]/table/tr[6]/td[8]/text()'):
                        item = BkstrItem()
                        item["price1e"] = t20.extract()[0]#.strip()
                        yield item
		t21 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[2]/text()'):
                        item = BkstrItem()
                        item["type2a"] = t21.extract()[0]#.strip()
                        yield item
		t22 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[2]/text()'):
                        item = BkstrItem()
                        item["type2b"] = t22.extract()[0]#.strip()
                        yield item
		t23 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[2]/text()'):
                        item = BkstrItem()
                        item["type2c"] = t23.extract()[0]#.strip()
                        yield item
		t24 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[2]/text()'):
                        item = BkstrItem()
                        item["type2d"] = t24.extract()[0]#.strip()
                        yield item
		t25 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[2]/text()'):
                        item = BkstrItem()
                        item["type2e"] = t25.extract()[0]#.strip()
                        yield item		
		t26 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent2a"] = t26.extract()[0]#.strip()
                        yield item
		t27 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent2b"] = t27.extract()[0]#.strip()
                        yield item
		t28 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent2c"] = t28.extract()[0]#.strip()
                        yield item
		t29 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent2d"] = t29.extract()[0]#.strip()
                        yield item
		t30 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent2e"] = t30.extract()[0]#.strip()
                        yield item
		t31 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[4]/text()'):
                        item = BkstrItem()
                        item["option2a"] = t31.extract()[0]#.strip()
                        yield item
		t32 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[4]/text()'):
                        item = BkstrItem()
                        item["option2b"] = t32.extract()[0]#.strip()
                        yield item
		t33 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[4]/text()'):
                        item = BkstrItem()
                        item["option2c"] = t33.extract()[0]#.strip()
                        yield item
		t34 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[4]/text()'):
                        item = BkstrItem()
                        item["option2d"] = t34.extract()[0]#.strip()
                        yield item
		t35 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[4]/text()'):
                        item = BkstrItem()
                        item["option2e"] = t35.extract()[0]#.strip()
                        yield item
		t36 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price2a"] = t36.extract()[0]#.strip()
                        yield item
		t37 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[3]/td[8]/text()'):
                        item = BkstrItem()
                        item["price2b"] = t37.extract()[0]#.strip()
                        yield item
		t38 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[4]/td[8]/text()'):
                        item = BkstrItem()
                        item["price2c"] = t38.extract()[0]#.strip()
                        yield item
		t39 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[5]/td[8]/text()'):
                        item = BkstrItem()
                        item["price2d"] = t39.extract()[0]#.strip()
                        yield item
		t40 = response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_2"]/div[2]/table/tr[6]/td[8]/text()'):
                        item = BkstrItem()
                        item["price2e"] = t40.extract()[0]#.strip()
                        yield item
		t41 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[2]/text()'):
                        item = BkstrItem()
                        item["type3a"] = t41.extract()[0]#.strip()
                        yield item
		t42 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[2]/text()'):
                        item = BkstrItem()
                        item["type3b"] = t42.extract()[0]#.strip()
                        yield item
		t43 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[2]/text()'):
                        item = BkstrItem()
                        item["type3c"] = t43.extract()[0]#.strip()
                        yield item
		t44 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[2]/text()'):
                        item = BkstrItem()
                        item["type3d"] = t44.extract()[0]#.strip()
                        yield item
		t45 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[2]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[2]/text()'):
                        item = BkstrItem()
                        item["type3e"] = t45.extract()[0]#.strip()
                        yield item		
		t46 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent3a"] = t46.extract()[0]#.strip()
                        yield item
		t47 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent3b"] = t47.extract()[0]#.strip()
                        yield item
		t48 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent3c"] = t48.extract()[0]#.strip()
                        yield item
		t49 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent3d"] = t49.extract()[0]#.strip()
                        yield item
		t50 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[3]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[3]/text()'):
                        item = BkstrItem()
                        item["buyrent3e"] = t50.extract()[0]#.strip()
                        yield item
		t51 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[4]/text()'):
                        item = BkstrItem()
                        item["option3a"] = t51.extract()[0]#.strip()
                        yield item
		t52 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[4]/text()'):
                        item = BkstrItem()
                        item["option3b"] = t52.extract()[0]#.strip()
                        yield item
		t53 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[4]/text()'):
                        item = BkstrItem()
                        item["option3c"] = t53.extract()[0]#.strip()
                        yield item
		t54 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[4]/text()'):
                        item = BkstrItem()
                        item["option3d"] = t54.extract()[0]#.strip()
                        yield item
		t55 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[4]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[4]/text()'):
                        item = BkstrItem()
                        item["option3e"] = t55.extract()[0]#.strip()
                        yield item
		t56 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[2]/td[8]/text()'):
                        item = BkstrItem()
                        item["price3a"] = t56.extract()[0]#.strip()
                        yield item
		t57 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[3]/td[8]/text()'):
                        item = BkstrItem()
                        item["price3b"] = t57.extract()[0]#.strip()
                        yield item
		t58 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[4]/td[8]/text()'):
                        item = BkstrItem()
                        item["price3c"] = t58.extract()[0]#.strip()
                        yield item
		t59 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[5]/td[8]/text()'):
                        item = BkstrItem()
                        item["price3d"] = t59.extract()[0]#.strip()
                        yield item
		t60 = response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[8]/text()')
                for sel in response.xpath('//*[@id="OrderItemAdd_3"]/div[2]/table/tr[6]/td[8]/text()'):
                        item = BkstrItem()
                        item["price3e"] = t60.extract()[0]#.strip()
                        yield item


		print items






	



