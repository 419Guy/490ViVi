# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

#import scrapy
from scrapy.item import Item, Field

class BkstrItem(Item):
	course = Field()
	title1 = Field()
	author1 = Field()
	isbn1 = Field()
	newprice1 = Field()
	usedprice1 = Field()
	title2 = Field()
	author2 = Field()
	isbn2 = Field()
	newprice2 = Field()
	usedprice2 = Field()
	title3 = Field()
	author3 = Field()
	isbn3 = Field()
	newprice3 = Field()
	usedprice3 = Field()

