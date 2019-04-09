function openTab(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

if( document.getElementById("defaultOpen") !== null ){
	document.getElementById("defaultOpen").click();
}

jQuery(document).ready(function($){
	
	/*//////////////////// REGISTER PAGE ////////////////////////*/
	
	var companies = {
		"Company Name": "",
		"Scenario2 User1": "Test",
		"Scenario2 User2": "Test",
		"Scenario2 User3": "Test",
		"Scenario2 User4": "Test",
		"Scenario3 User1": "Test",
		"Scenario3 User2": "Test",
		"Scenario3 User3": "Test",
		"Scenario3 User4": "Test",
		"Honey": "Design",
		"3I Group Plc": "Financial Services",
		"3I Infrastructure Plc": "Equity Investment Instruments",
		"888 Holdings Plc": "Travel & Leisure",
		"Aa Plc": "Support Services",
		"Aberforth Smaller Companies Trust Plc": "Equity Investment Instruments",
		"Admiral Group Plc": "Non-Life Insurance",
		"Aggreko Plc": "Support Services",
		"Alliance Trust Plc": "Equity Investment Instruments",
		"Amigo Holdings Plc": "Financial Services",
		"Anglo American Plc": "Mining",
		"Antofagasta Plc": "Mining",
		"Ascential Plc": "Media & Entertainment",
		"Ashmore Group Plc": "Financial Services",
		"Ashtead Group Plc": "Support Services",
		"Associated British Foods Plc": "Food Producers",
		"Assura Plc": "Real Estate Investments",
		"Astrazeneca Plc": "Pharmaceuticals and Biotechnology",
		"Auto Trader Group Plc": "Media & Entertainment",
		"Avast Plc": "Software & Computer Services",
		"Aveva Group Plc": "Software & Computer Services",
		"Aviva Plc": "Life Insurance",
		"B&M European Value Retail Sa": "General Retailers",
		"Babcock International Group Plc": "Support Services",
		"Bae Systems Plc": "Aerospace & Defence",
		"Baillie Gifford Japan Trust Plc (The)": "Equity Investment Instruments",
		"Bakkavor Group Plc": "Food Producers",
		"Balfour Beatty Plc": "Construction &  Materials",
		"Bank of Georgia Group Plc": "Banks",
		"Bankers Investment Trust Plc": "Equity Investment Instruments",
		"Barclays Plc": "Banks",
		"Barr": "Beverages",
		"Barratt Developments Plc": "Household Goods & Home Construction",
		"Bba Aviation Plc": "Industrial Transportation",
		"Bca Marketplace Plc": "Support Services",
		"Beazley Plc": "Non-Life Insurance",
		"Bellway Plc": "Household Goods & Home Construction",
		"Berkeley Group Holdings Plc": "Household Goods & Home Construction",
		"Bhp Billiton Plc": "Mining",
		"Big Yellow Group Plc": "Real Estate Investments",
		"Blackrock Smaller Cos Trust Plc": "Equity Investment Instruments",
		"Bodycote Plc": "Industrial Engineering",
		"Bovis Homes Group Plc": "Household Goods & Home Construction",
		"BP PLC": "Oil & Gas Producers",
		"Brewin Dolphin Holdings Plc": "Financial Services",
		"British American Tobacco Plc": "Tobacco",
		"British Empire Trust Plc": "Equity Investment Instruments",
		"British Land Co Plc": "Real Estate Investments",
		"Britvic Plc": "Beverages",
		"Bt Group Plc": "Fixed Line Telecommunications",
		"Btg Plc": "Pharmaceuticals and Biotechnology",
		"Bunzl Plc": "Support Services",
		"Burberry Group Plc": "Personal Goods",
		"Cairn Energy Plc": "Oil & Gas Producers",
		"Caledonia Investments Plc": "Equity Investment Instruments",
		"Capita Plc": "Support Services",
		"Capital Counties Properties Plc": "Real Estate Investment & Services",
		"Card Factory Plc": "General Retailers",
		"Carnival Plc": "Travel & Leisure",
		"Centamin Plc": "Mining",
		"Centrica Plc": "Gas, Water & Multiutilities",
		"Charter Court": "Financial Services",
		"Cineworld Group Plc": "Travel & Leisure",
		"City Of London Investment Trust Plc": "Equity Investment Instruments",
		"Clarkson Plc": "Industrial Transportation",
		"Close Brothers Group Plc": "Banks",
		"Cls Hldgs Plc": "Real Estate Investment & Services",
		"Coats Group": "General Industrials",
		"Cobham Plc": "Aerospace & Defence",
		"Coca-Cola Hbc Ag": "Beverages",
		"Compass Group Plc": "Travel & Leisure",
		"Computacenter Plc": "Software & Computer Services",
		"ContourGlobal Plc": "Electricity",
		"Convatec Group Plc": "Health Care Equipment & Services",
		"Countryside Properties Plc": "Household Goods & Home Construction",
		"Cranswick Plc": "Food Producers",
		"Crest Nicholson Holdings Plc": "Household Goods & Home Construction",
		"Crh Plc": "Construction &  Materials",
		"Croda International Plc": "Chemicals",
		"Cybg Plc": "Banks",
		"Daejan Holdings Plc": "Real Estate Investment & Services",
		"Dairy Crest Group Plc": "Food Producers",
		"Dcc Plc": "Support Services",
		"Dechra Pharmaceuticals Plc": "Pharmaceuticals and Biotechnology",
		"Derwent London Plc": "Real Estate Investments",
		"Diageo Plc": "Beverages",
		"Diploma Plc": "Support Services",
		"Direct Line Insurance Group Plc": "Non-Life Insurance",
		"Dixons Carphone Plc": "General Retailers",
		"DominoS Pizza Group Plc": "Travel & Leisure",
		"Drax Group Plc": "Electricity",
		"Ds Smith Plc": "General Industrials",
		"Dunelm Group Plc": "General Retailers",
		"Easyjet Plc": "Travel & Leisure",
		"Edinburgh Dragon Trust Plc": "Equity Investment Instruments",
		"Edinburgh Investment Trust Plc": "Equity Investment Instruments",
		"Ei Group Plc": "Travel & Leisure",
		"Electrocomponents Plc": "Support Services",
		"Elementis Plc": "Chemicals",
		"Energean Oil & Gas Plc": "Oil & Gas Producers",
		"Entertainment One Ltd": "Media & Entertainment",
		"Equiniti Group": "Support Services",
		"Essentra Plc": "Support Services",
		"Esure Group Plc": "Non-Life Insurance",
		"Euromoney Institutional Investor Plc": "Media & Entertainment",
		"Evraz Plc": "Industrial Metals & Mining",
		"Experian Plc": "Support Services",
		"F&C Commercial Property Trust Ltd": "Real Estate Investment & Services",
		"F&C Global Smaller Companies Plc": "Equity Investment Instruments",
		"FDM Group Holdings": "Software & Computer Services",
		"Ferguson Plc": "Support Services",
		"Ferrexpo Plc": "Industrial Metals & Mining",
		"Fidelity China Special Situations Plc": "Equity Investment Instruments",
		"Fidelity European Values Plc": "Equity Investment Instruments",
		"Fidelity Special Values Plc": "Equity Investment Instruments",
		"Finsbury Growth & Income Trust Plc": "Equity Investment Instruments",
		"Firstgroup Plc": "Travel & Leisure",
		"Fisher James Sons": "Industrial Transportation",
		"Foreign & Colonial Investment Trust Plc": "Equity Investment Instruments",
		"Fresnillo Plc": "Mining",
		"G4S Plc": "Support Services",
		"Galliford Try Plc": "Household Goods & Home Construction",
		"Games Workshop": "Leisure Goods",
		"Gcp Infrastructure Investments Ltd": "Equity Investment Instruments",
		"Genesis Emerging Markets Fund Ltd": "Equity Investment Instruments",
		"Genus Plc": "Pharmaceuticals and Biotechnology",
		"Glaxosmithkline Plc": "Pharmaceuticals and Biotechnology",
		"Glencore Plc": "Mining",
		"Go-Ahead Group Plc": "Travel & Leisure",
		"Grafton Group Plc": "Support Services",
		"Grainger Plc": "Real Estate Investment & Services",
		"Great Portland Estates Plc": "Real Estate Investments",
		"Greencoat Uk Wind Plc": "Equity Investment Instruments",
		"Greencore Group Plc": "Food Producers",
		"Greene King Plc": "Travel & Leisure",
		"Greggs Plc": "Food & Drug Retailers",
		"Gvc Holdings Plc": "Travel & Leisure",
		"Halfords Group Plc": "General Retailers",
		"Halma Plc": "Electronic & Electrical Equipment",
		"Hammerson Plc": "Real Estate Investments",
		"Harbourvest Global Private Equity Ltd": "Equity Investment Instruments",
		"Hargreaves Lansdown Plc": "Financial Services",
		"Hastings Group Holdings Plc": "Non-Life Insurance",
		"Hays Plc": "Support Services",
		"Herald Investment Trust Plc": "Equity Investment Instruments",
		"Hicl Infrastructure Co Ltd": "Equity Investment Instruments",
		"Hikma Pharmaceuticals Plc": "Pharmaceuticals and Biotechnology",
		"Hill Smith Hldgs Plc": "Industrial Engineering",
		"Hilton Food Group Plc": "Food Producers",
		"Hiscox Ltd": "Non-Life Insurance",
		"Hochschild Mining Plc": "Mining",
		"Homeserve Plc": "Support Services",
		"Howden Joinery Group Plc": "Support Services",
		"Hsbc Holdings Plc": "Banks",
		"Hunting Plc": "Oil Equipment & Services",
		"Ibstock Plc": "Construction &  Materials",
		"Ig Group Holdings Plc": "Financial Services",
		"Imi Plc": "Industrial Engineering",
		"Imperial Brands Plc": "Tobacco",
		"Inchcape Plc": "General Retailers",
		"Indivior Plc": "Pharmaceuticals and Biotechnology",
		"Informa Plc": "Media & Entertainment",
		"Inmarsat Plc": "Mobile Telecommunications",
		"IntegraFin Holdings plc": "Financial Services",
		"Intercontinental Hotels Group Plc": "Travel & Leisure",
		"Intermediate Capital Group Plc": "Financial Services",
		"International Consolidated Airlines Group Sa": "Travel & Leisure",
		"International Public Partnerships Ltd": "Equity Investment Instruments",
		"Intertek Group Plc": "Support Services",
		"Intu Properties Plc": "Real Estate Investments",
		"Investec Plc": "Financial Services",
		"Ip Group Plc": "Financial Services",
		"Itv Plc": "Media & Entertainment",
		"Iwg Plc": "Support Services",
		"Jardine Lloyd Thompson Group Plc": "Non-Life Insurance",
		"Jd Sports Fashion Plc": "General Retailers",
		"John Laing Group Plc": "Financial Services",
		"Johnson Matthey Plc": "Chemicals",
		"Jpmorgan American Investment Trust Plc": "Equity Investment Instruments",
		"Jpmorgan Emerging Markets Investment Trust Plc": "Equity Investment Instruments",
		"Jpmorgan Indian Investment Trust Plc": "Equity Investment Instruments",
		"Jpmorgan Japanese Investment Trust Plc": "Equity Investment Instruments",
		"Jupiter European Opportunities Trust Plc": "Equity Investment Instruments",
		"Jupiter Fund Management Plc": "Financial Services",
		"Just Eat Plc": "General Retailers",
		"Just Group Plc": "Life Insurance",
		"Kaz Minerals Plc": "Mining",
		"Keller Group Plc": "Construction &  Materials",
		"Kier Group Plc": "Construction &  Materials",
		"Kingfisher Plc": "General Retailers",
		"Lancashire Holdings Ltd": "Non-Life Insurance",
		"Land Securities Group Plc": "Real Estate Investments",
		"Legal General Group Plc": "Life Insurance",
		"Lloyds Banking Group Plc": "Banks",
		"London Stock Exchange Group Plc": "Financial Services",
		"Londonmetric Property Plc": "Real Estate Investments",
		"Man Group Plc": "Financial Services",
		"Marks Spencer Group Plc": "General Retailers",
		"Marshalls Plc": "Construction &  Materials",
		"Mediclinic International Plc": "Health Care Equipment & Services",
		"Meggitt Plc": "Aerospace & Defence",
		"Melrose Industries": "Construction &  Materials",
		"Mercantile Investment Trust Plc": "Equity Investment Instruments",
		"Merlin Entertainments Plc": "Travel & Leisure",
		"Metro Bank Plc": "Banks",
		"Micro Focus International Plc": "Software & Computer Services",
		"Millennium Copthorne Hotels Plc": "Travel & Leisure",
		"Mitchells Butlers Plc": "Travel & Leisure",
		"Mondi Plc": "Forestry & Paper",
		"Moneysupermarket.Com Group Plc": "Media & Entertainment",
		"Monks Investment Trust Plc": "Equity Investment Instruments",
		"Morgan Advanced Materials Plc": "Electronic & Electrical Equipment",
		"Murray International Trust Plc": "Equity Investment Instruments",
		"National Express Group Plc": "Travel & Leisure",
		"National Grid Plc": "Gas, Water & Multiutilities",
		"Nb Global Floating Rate Income Fund Ltd": "Equity Investment Instruments",
		"Newriver Reit Plc": "Real Estate Investments",
		"Nex Group Plc": "Financial Services",
		"Next Plc": "General Retailers",
		"Nmc Health Plc": "Health Care Equipment & Services",
		"Ocado Group Plc": "Food & Drug Retailers",
		"On the Beach": "Travel & Leisure",
		"Onesavings Bank Plc": "Financial Services",
		"Paddy Power Betfair Plc": "Travel & Leisure",
		"Pagegroup Plc": "Support Services",
		"Pantheon International Plc": "Equity Investment Instruments",
		"Paragon Banking Group Plc": "Financial Services",
		"Pearson Plc": "Media & Entertainment",
		"Pennon Group Plc": "Gas, Water & Multiutilities",
		"Perpetual Income & Growth Investment Trust Plc": "Equity Investment Instruments",
		"Pershing Square Holdings Ltd": "Equity Investment Instruments",
		"Persimmon Plc": "Household Goods & Home Construction",
		"Personal Assets Trust Plc": "Equity Investment Instruments",
		"Petrofac Ltd": "Oil Equipment & Services",
		"Phoenix Group Holdings": "Life Insurance",
		"Playtech Plc": "Travel & Leisure",
		"Plus500 Limited": "Financial Services",
		"Polar Capital Technology Trust Plc": "Equity Investment Instruments",
		"Polymetal International Plc": "Mining",
		"Polypipe Group Plc": "Construction &  Materials",
		"Premier Oil Plc": "Oil & Gas Producers",
		"Primary Health Properties Plc": "Real Estate Investments",
		"Provident Financial Plc": "Financial Services",
		"Prudential Plc": "Life Insurance",
		"Pz Cussons Plc": "Personal Goods",
		"Qinetiq Group Plc": "Aerospace & Defence",
		"Quilter Plc": "Financial Services",
		"Randgold Resources Ltd": "Mining",
		"Rank Group Plc": "Travel & Leisure",
		"Rathbone Brothers Plc": "Financial Services",
		"Reckitt Benckiser Group Plc": "Household Goods & Home Construction",
		"Redrow Plc": "Household Goods & Home Construction",
		"Relx Plc": "Media & Entertainment",
		"Renewables Infrastructure Group Ltd": "Equity Investment Instruments",
		"Renishaw Plc": "Electronic & Electrical Equipment",
		"Rentokil Initial Plc": "Support Services",
		"RHI Magnesita": "Industrial Engineering",
		"Rightmove Plc": "Media & Entertainment",
		"Rio Tinto Plc": "Mining",
		"Rit Capital Partners Plc": "Equity Investment Instruments",
		"Riverstone Energy Ltd": "Equity Investment Instruments",
		"Rolls-Royce Holdings Plc": "Aerospace & Defence",
		"Rotork Plc": "Industrial Engineering",
		"Royal Bank Of Scotland Group Plc": "Banks",
		"Royal Dutch Shell Plc": "Oil & Gas Producers",
		"Royal Mail Plc": "Industrial Transportation",
		"Rpc Group Plc": "General Industrials",
		"Rsa Insurance Group Plc": "Non-Life Insurance",
		"Safestore Holdings Plc": "Real Estate Investments",
		"Saga Plc": "General Retailers",
		"Sage Group Plc": "Software & Computer Services",
		"Sainsburys Supermarkets Ltd": "Food & Drug Retailers",
		"Sanne Group Plc": "Support Services",
		"Savills Plc": "Real Estate Investment & Services",
		"Schroder Asia Pacific Fund Plc": "Equity Investment Instruments",
		"Schroders Plc": "Financial Services",
		"Scottish Investment Trust Plc": "Equity Investment Instruments",
		"Scottish Mortgage Investment Trust Plc": "Equity Investment Instruments",
		"Segro Plc": "Real Estate Investments",
		"Senior Plc": "Aerospace & Defence",
		"Sequoia Economic Infrastructure Income Fund Ltd": "Equity Investment Instruments",
		"Serco Group Plc": "Support Services",
		"Severn Trent Plc": "Gas, Water & Multiutilities",
		"Shaftesbury Plc": "Real Estate Investments",
		"Shire Plc": "Pharmaceuticals and Biotechnology",
		"Sig Plc": "Support Services",
		"Sirius Minerals": "Chemicals",
		"Sky Plc": "Media & Entertainment",
		"Smith Nephew Plc": "Health Care Equipment & Services",
		"Smiths Group Plc": "General Industrials",
		"Smurfit Kappa Group Plc": "General Industrials",
		"Softcat Plc": "Software & Computer Services",
		"Sophos Group Plc": "Software & Computer Services",
		"Spectris Plc": "Electronic & Electrical Equipment",
		"Spirax-Sarco Engineering Plc": "Industrial Engineering",
		"Spire Healthcare Group Plc": "Health Care Equipment & Services",
		"Spirent Communications Plc": "Technology Hardware & Equipment",
		"Sports Direct International Plc": "General Retailers",
		"Sse Plc": "Electricity",
		"Ssp Group Plc": "Travel & Leisure",
		"St JamesS Place Plc": "Life Insurance",
		"St Modwen Properties Plc": "Real Estate Investment & Services",
		"Stagecoach Group Plc": "Travel & Leisure",
		"Standard Chartered Plc": "Banks",
		"Standard Life Aberdeen": "Life Insurance",
		"Stobart Group": "Industrial Transportation",
		"Superdry Plc": "Personal Goods",
		"Syncona Ltd": "Equity Investment Instruments",
		"Synthomer Plc": "Chemicals",
		"Talktalk Telecom Group Plc": "Fixed Line Telecommunications",
		"Tate Lyle Plc": "Food Producers",
		"Taylor Wimpey Plc": "Household Goods & Home Construction",
		"TBC Bank Group": "Banks",
		"Ted Baker Plc": "Personal Goods",
		"Telecom Plus Plc": "Fixed Line Telecommunications",
		"Temple Bar Investment Trust Plc": "Equity Investment Instruments",
		"Templeton Emerging Markets Investment Trust Plc": "Equity Investment Instruments",
		"Tesco Plc": "Food & Drug Retailers",
		"Thomas Cook Group Plc": "Travel & Leisure",
		"TI Fluid Systems": "Automobiles & Parts",
		"Tp Icap Plc": "Financial Services",
		"Tr Property Investment Trust Plc": "Equity Investment Instruments",
		"Travis Perkins Plc": "Support Services",
		"Tritax Big Box Reit Plc": "Real Estate Investments",
		"Tui Ag": "Travel & Leisure",
		"Tullow Oil Plc": "Oil & Gas Producers",
		"Udg Healthcare Plc": "Health Care Equipment & Services",
		"Uk Commercial Property Reit Ltd": "Real Estate Investments",
		"Ultra Electronics Hldgs Plc": "Aerospace & Defence",
		"Unilever Plc": "Personal Goods",
		"Unite Group Plc": "Real Estate Investments",
		"United Utilities Group Plc": "Gas, Water & Multiutilities",
		"Vesuvius Plc": "General Industrials",
		"Victrex Plc": "Chemicals",
		"Vietnam Enterprise Investments Ltd (Veil)": "Equity Investment Instruments",
		"Vinacapital Vietnam Opportunity Fund Ltd": "Equity Investment Instruments",
		"Virgin Money Holdings": "Banks",
		"Vivo Energy ": "General Retailers",
		"Vodafone Group Plc": "Mobile Telecommunications",
		"Weir Group Plc": "Industrial Engineering",
		"Wetherspoon (J.D.) Plc": "Travel & Leisure",
		"Wh Smith Plc": "General Retailers",
		"Whitbread Plc": "Travel & Leisure",
		"William Hill Plc": "Travel & Leisure",
		"Witan Investment Trust Plc": "Equity Investment Instruments",
		"Wizz Air Holdings Plc": "Travel & Leisure",
		"Wm Morrison Supermarkets Plc": "Food & Drug Retailers",
		"Wood Group": "Oil Equipment & Services",
		"Workspace Group Plc": "Real Estate Investments",
		"Worldwide Healthcare Trust Plc": "Equity Investment Instruments",
		"Wpp Plc": "Media & Entertainment"
	};
	
	var company_name = Object.keys(companies);
	
	
	var ftseIndex = {
		'100': [
			"Scenario2 User1",
			"Scenario2 User2",
			"Scenario2 User3",
			"Scenario2 User4",
			"Scenario3 User1",
			"Scenario3 User2",
			"Scenario3 User3",
			"Scenario3 User4",
			"Honey",
			"3I Group Plc",
			"Admiral Group Plc",
			"Anglo American Plc",
			"Antofagasta Plc",
			"Ashtead Group Plc",
			"Associated British Foods Plc",
			"Astrazeneca Plc",
			"Aviva Plc",
			"Bae Systems Plc",
			"Barclays Plc",
			"Barratt Developments Plc",
			"Berkeley Group Holdings Plc",
			"Bhp Billiton Plc",
			"BP PLC",
			"British American Tobacco Plc",
			"British Land Co Plc",
			"Bt Group Plc",
			"Bunzl Plc",
			"Burberry Group Plc",
			"Carnival Plc",
			"Centrica Plc",
			"Coca-Cola Hbc Ag",
			"Compass Group Plc",
			"Crh Plc",
			"Croda International Plc",
			"Dcc Plc",
			"Diageo Plc",
			"Direct Line Insurance Group Plc",
			"Ds Smith Plc",
			"Easyjet Plc",
			"Evraz Plc",
			"Experian Plc",
			"Ferguson Plc",
			"Fresnillo Plc",
			"Glaxosmithkline Plc",
			"Glencore Plc",
			"Gvc Holdings Plc",
			"Halma Plc",
			"Hargreaves Lansdown Plc",
			"Hsbc Holdings Plc",
			"Imperial Brands Plc",
			"Informa Plc",
			"Intercontinental Hotels Group Plc",
			"International Consolidated Airlines Group Sa",
			"Intertek Group Plc",
			"Itv Plc",
			"Johnson Matthey Plc",
			"Just Eat Plc",
			"Kingfisher Plc",
			"Land Securities Group Plc",
			"Legal General Group Plc",
			"Lloyds Banking Group Plc",
			"London Stock Exchange Group Plc",
			"Marks Spencer Group Plc",
			"Melrose Industries",
			"Micro Focus International Plc",
			"Mondi Plc",
			"National Grid Plc",
			"Next Plc",
			"Nmc Health Plc",
			"Ocado Group Plc",
			"Paddy Power Betfair Plc",
			"Pearson Plc",
			"Persimmon Plc",
			"Prudential Plc",
			"Randgold Resources Ltd",
			"Reckitt Benckiser Group Plc",
			"Relx Plc",
			"Rentokil Initial Plc",
			"Rightmove Plc",
			"Rio Tinto Plc",
			"Rolls-Royce Holdings Plc",
			"Royal Bank Of Scotland Group Plc",
			"Royal Dutch Shell Plc",
			"Royal Mail Plc",
			"Rsa Insurance Group Plc",
			"Sage Group Plc",
			"Sainsburys Supermarkets Ltd",
			"Schroders Plc",
			"Scottish Mortgage Investment Trust Plc",
			"Segro Plc",
			"Severn Trent Plc",
			"Shire Plc",
			"Sky Plc",
			"Smith Nephew Plc",
			"Smiths Group Plc",
			"Smurfit Kappa Group Plc",
			"Sse Plc",
			"St JamesS Place Plc",
			"Standard Chartered Plc",
			"Standard Life Aberdeen",
			"Taylor Wimpey Plc",
			"Tesco Plc",
			"Tui Ag",
			"Unilever Plc",
			"United Utilities Group Plc",
			"Vodafone Group Plc",
			"Whitbread Plc",
			"Wm Morrison Supermarkets Plc",
			"Wpp Plc"
		],
		'250': [
			"3I Infrastructure Plc",
			"888 Holdings Plc",
			"Aa Plc",
			"Aberforth Smaller Companies Trust Plc",
			"Aggreko Plc",
			"Alliance Trust Plc",
			"Amigo Holdings Plc",
			"Ascential Plc",
			"Ashmore Group Plc",
			"Assura Plc",
			"Auto Trader Group Plc",
			"Avast Plc",
			"Aveva Group Plc",
			"B&M European Value Retail Sa",
			"Babcock International Group Plc",
			"Baillie Gifford Japan Trust Plc (The)",
			"Bakkavor Group Plc",
			"Balfour Beatty Plc",
			"Bank of Georgia Group Plc",
			"Bankers Investment Trust Plc",
			"Barr",
			"Bba Aviation Plc",
			"Bca Marketplace Plc",
			"Beazley Plc",
			"Bellway Plc",
			"Big Yellow Group Plc",
			"Blackrock Smaller Cos Trust Plc",
			"Bodycote Plc",
			"Bovis Homes Group Plc",
			"Brewin Dolphin Holdings Plc",
			"British Empire Trust Plc",
			"Britvic Plc",
			"Btg Plc",
			"Cairn Energy Plc",
			"Caledonia Investments Plc",
			"Capita Plc",
			"Capital Counties Properties Plc",
			"Card Factory Plc",
			"Centamin Plc",
			"Charter Court",
			"Cineworld Group Plc",
			"City Of London Investment Trust Plc",
			"Clarkson Plc",
			"Close Brothers Group Plc",
			"Cls Hldgs Plc",
			"Coats Group",
			"Cobham Plc",
			"Computacenter Plc",
			"ContourGlobal Plc",
			"Convatec Group Plc",
			"Countryside Properties Plc",
			"Cranswick Plc",
			"Crest Nicholson Holdings Plc",
			"Cybg Plc",
			"Daejan Holdings Plc",
			"Dairy Crest Group Plc",
			"Dechra Pharmaceuticals Plc",
			"Derwent London Plc",
			"Diploma Plc",
			"Dixons Carphone Plc",
			"DominoS Pizza Group Plc",
			"Drax Group Plc",
			"Dunelm Group Plc",
			"Edinburgh Dragon Trust Plc",
			"Edinburgh Investment Trust Plc",
			"Ei Group Plc",
			"Electrocomponents Plc",
			"Elementis Plc",
			"Energean Oil & Gas Plc",
			"Entertainment One Ltd",
			"Equiniti Group",
			"Essentra Plc",
			"Esure Group Plc",
			"Euromoney Institutional Investor Plc",
			"F&C Commercial Property Trust Ltd",
			"F&C Global Smaller Companies Plc",
			"FDM Group Holdings",
			"Ferrexpo Plc",
			"Fidelity China Special Situations Plc",
			"Fidelity European Values Plc",
			"Fidelity Special Values Plc",
			"Finsbury Growth & Income Trust Plc",
			"Firstgroup Plc",
			"Fisher James Sons",
			"Foreign & Colonial Investment Trust Plc",
			"G4S Plc",
			"Galliford Try Plc",
			"Games Workshop",
			"Gcp Infrastructure Investments Ltd",
			"Genesis Emerging Markets Fund Ltd",
			"Genus Plc",
			"Go-Ahead Group Plc",
			"Grafton Group Plc",
			"Grainger Plc",
			"Great Portland Estates Plc",
			"Greencoat Uk Wind Plc",
			"Greencore Group Plc",
			"Greene King Plc",
			"Greggs Plc",
			"Halfords Group Plc",
			"Hammerson Plc",
			"Harbourvest Global Private Equity Ltd",
			"Hastings Group Holdings Plc",
			"Hays Plc",
			"Herald Investment Trust Plc",
			"Hicl Infrastructure Co Ltd",
			"Hikma Pharmaceuticals Plc",
			"Hill Smith Hldgs Plc",
			"Hilton Food Group Plc",
			"Hiscox Ltd",
			"Hochschild Mining Plc",
			"Homeserve Plc",
			"Howden Joinery Group Plc",
			"Hunting Plc",
			"Ibstock Plc",
			"Ig Group Holdings Plc",
			"Imi Plc",
			"Inchcape Plc",
			"Indivior Plc",
			"Inmarsat Plc",
			"IntegraFin Holdings plc",
			"Intermediate Capital Group Plc",
			"International Public Partnerships Ltd",
			"Intu Properties Plc",
			"Investec Plc",
			"Ip Group Plc",
			"Iwg Plc",
			"Jardine Lloyd Thompson Group Plc",
			"Jd Sports Fashion Plc",
			"John Laing Group Plc",
			"Jpmorgan American Investment Trust Plc",
			"Jpmorgan Emerging Markets Investment Trust Plc",
			"Jpmorgan Indian Investment Trust Plc",
			"Jpmorgan Japanese Investment Trust Plc",
			"Jupiter European Opportunities Trust Plc",
			"Jupiter Fund Management Plc",
			"Just Group Plc",
			"Kaz Minerals Plc",
			"Keller Group Plc",
			"Kier Group Plc",
			"Lancashire Holdings Ltd",
			"Londonmetric Property Plc",
			"Man Group Plc",
			"Marshalls Plc",
			"Mediclinic International Plc",
			"Meggitt Plc",
			"Mercantile Investment Trust Plc",
			"Merlin Entertainments Plc",
			"Metro Bank Plc",
			"Millennium Copthorne Hotels Plc",
			"Mitchells Butlers Plc",
			"Moneysupermarket.Com Group Plc",
			"Monks Investment Trust Plc",
			"Morgan Advanced Materials Plc",
			"Murray International Trust Plc",
			"National Express Group Plc",
			"Nb Global Floating Rate Income Fund Ltd",
			"Newriver Reit Plc",
			"Nex Group Plc",
			"On the Beach",
			"Onesavings Bank Plc",
			"Pagegroup Plc",
			"Pantheon International Plc",
			"Paragon Banking Group Plc",
			"Pennon Group Plc",
			"Perpetual Income & Growth Investment Trust Plc",
			"Pershing Square Holdings Ltd",
			"Personal Assets Trust Plc",
			"Petrofac Ltd",
			"Phoenix Group Holdings",
			"Playtech Plc",
			"Plus500 Limited",
			"Polar Capital Technology Trust Plc",
			"Polymetal International Plc",
			"Polypipe Group Plc",
			"Premier Oil Plc",
			"Primary Health Properties Plc",
			"Provident Financial Plc",
			"Pz Cussons Plc",
			"Qinetiq Group Plc",
			"Quilter Plc",
			"Rank Group Plc",
			"Rathbone Brothers Plc",
			"Redrow Plc",
			"Renewables Infrastructure Group Ltd",
			"Renishaw Plc",
			"RHI Magnesita",
			"Rit Capital Partners Plc",
			"Riverstone Energy Ltd",
			"Rotork Plc",
			"Rpc Group Plc",
			"Safestore Holdings Plc",
			"Saga Plc",
			"Sanne Group Plc",
			"Savills Plc",
			"Schroder Asia Pacific Fund Plc",
			"Scottish Investment Trust Plc",
			"Senior Plc",
			"Sequoia Economic Infrastructure Income Fund Ltd",
			"Serco Group Plc",
			"Shaftesbury Plc",
			"Sig Plc",
			"Sirius Minerals",
			"Softcat Plc",
			"Sophos Group Plc",
			"Spectris Plc",
			"Spirax-Sarco Engineering Plc",
			"Spire Healthcare Group Plc",
			"Spirent Communications Plc",
			"Sports Direct International Plc",
			"Ssp Group Plc",
			"St Modwen Properties Plc",
			"Stagecoach Group Plc",
			"Stobart Group",
			"Superdry Plc",
			"Syncona Ltd",
			"Synthomer Plc",
			"Talktalk Telecom Group Plc",
			"Tate Lyle Plc",
			"TBC Bank Group",
			"Ted Baker Plc",
			"Telecom Plus Plc",
			"Temple Bar Investment Trust Plc",
			"Templeton Emerging Markets Investment Trust Plc",
			"Thomas Cook Group Plc",
			"TI Fluid Systems",
			"Tp Icap Plc",
			"Tr Property Investment Trust Plc",
			"Travis Perkins Plc",
			"Tritax Big Box Reit Plc",
			"Tullow Oil Plc",
			"Udg Healthcare Plc",
			"Uk Commercial Property Reit Ltd",
			"Ultra Electronics Hldgs Plc",
			"Unite Group Plc",
			"Vesuvius Plc",
			"Victrex Plc",
			"Vietnam Enterprise Investments Ltd (Veil)",
			"Vinacapital Vietnam Opportunity Fund Ltd",
			"Virgin Money Holdings",
			"Vivo Energy ",
			"Weir Group Plc",
			"Wetherspoon (J.D.) Plc",
			"Wh Smith Plc",
			"William Hill Plc",
			"Witan Investment Trust Plc",
			"Wizz Air Holdings Plc",
			"Wood Group",
			"Workspace Group Plc",
			"Worldwide Healthcare Trust Plc"
		]
	};
	
	var invTrust = [];

	var emptyFields = true;
	var emailCheck = false;
	var passCheck = false;
	var fNameCheck = false;
	var sNameCheck = false;
	var telCheck = false;
	var compCheck = false;

	var errorMessages = {
		company: "Please select company",
		empty: "Please complete all fields",
		emailFormat: "Please make sure you use a valid email address",
		emailMatch: "Your email addresses do not match",
		passwordFormat: "Please make sure your password meets the minimum requirements",
		passwordMatch: "Your passwords do not match",
		disclaimer: "Please tick the box to proceed",
		lettersOnly: "Please use only letters when typing your name",
		numbersOnly: "Please use only numbers when typing your phone number"
	};

	$("#company-name").select2({
		data: company_name
	});

	$("#company-name").on('change', function(){
		var comp = $(this).val();
		$('#sector, #sector_dis').val(companies[comp]);
		
		for(var key in ftseIndex) {
			var obj = ftseIndex[key];
			if(jQuery.inArray(comp, ftseIndex[key]) !== -1) {
				$('#ftseIndex').val(key);
			}
		}
		
		if(jQuery.inArray(comp, invTrust) !== -1) {
			$('#invTrust').val('Yes');
		} else {
			$('#invTrust').val('No');
		}

		if( comp === 'Company Name' || comp === '' ) {
			$(this).siblings('.error_msg').text(errorMessages.company);
			compCheck = false;
		} else {
			$(this).siblings('.error_msg').text('');
			compCheck = true;
		}
	});
	
	$('#disclaimer').on('change', function(){
		if( $('input#disclaimer').is(':checked') ) {
			$(this).siblings('.error_msg').text('');
		} else {
			$(this).siblings('.error_msg').text(errorMessages.disclaimer);
		}
	});

	$('input[type!="hidden"]').on('keyup blur', function(){
		var inputVal = $(this).val();

		if( inputVal.length == 0 ) {
			$(this).addClass('fail');
		} else {
			$(this).removeClass('fail');
			$(this).next('.error_msg').text('');
		}
		
		if( $(this).is('#email') ) {
			if( inputVal.indexOf('@') > -1 && inputVal.indexOf('.') > -1 ) {
				$(this).next('.error_msg').text('');
			} else {
				$(this).next('.error_msg').text(errorMessages.emailFormat);
			}
		}

		if( $(this).is('#email2') ) {
			if( $('#email').val() == inputVal ) {
				$(this).next('.error_msg').text('');
				emailCheck = true;
			} else {
				$(this).next('.error_msg').text(errorMessages.emailMatch);
				emailCheck = false;
			}
		}
		
		if( $(this).is('#first-name') ) {
			function hasNumber(myString) {
			  return /\d/.test(myString);
			}

			if( !hasNumber(inputVal) ) {
				$(this).next('.error_msg').text('');
				fNameCheck = true;
			} else {
				$(this).next('.error_msg').text(errorMessages.lettersOnly);
				fNameCheck = false;
			}
		}
		
		if( $(this).is('#last-name') ) {
			function hasNumber(myString) {
			  return /\d/.test(myString);
			}

			if( !hasNumber(inputVal) ) {
				$(this).next('.error_msg').text('');
				sNameCheck = true;
			} else {
				$(this).next('.error_msg').text(errorMessages.lettersOnly);
				sNameCheck = false;
			}
		}
		
		if( $(this).is('#contact-phone') ) {
			if( /^(?=.*\d)[\d ]+$/.test(inputVal) ) {
				$(this).next('.error_msg').text('');
				telCheck = true;
			} else {
				$(this).next('.error_msg').text(errorMessages.numbersOnly);
				telCheck = false;
			}
		}

		var empty = $('input[type!="hidden"], input:not([disabled])').filter(function() {
			return this.value === "";
		});

		if(empty.length) {
			emptyFields = true;
		} else {
			emptyFields = false;
		}
	});

	$('input, .checkbox').on('blur keyup click', function(){
		if( !emptyFields && compCheck && fNameCheck && sNameCheck && emailCheck && telCheck && $('input#disclaimer').is(':checked') ) {
			$('#submit-button').prop('disabled', false);
			$('.overlay').hide();
		} else {
			$('#submit-button').prop('disabled', true);
			$('.overlay').show();
		}
	});
	
//	$('.checkbox').on('click', function(){
//		if ($('input.checkbox').is(':checked')) {
//			$('.overlay').hide();
//		} else {
//			$('.overlay').show();
//		}
//	});

	$('#company-name').on('change', function(){
		if( compCheck && fNameCheck && sNameCheck && emailCheck && telCheck && $('input#disclaimer').is(':checked') ) {
			$('.overlay').hide();
			$('#submit-button').prop('disabled', false);
		} else {
			$('.overlay').show();
			$('#submit-button').prop('disabled', true);
		}
	});
	
	$('input').addClass('fail');
	
	$('.overlay-two').click(function(){
		$('.fail:not(#disclaimer, #company-name)').siblings('.error_msg').text(errorMessages.empty);
		if( !$('input#disclaimer').is(':checked') ) $('#disclaimer').siblings('.error_msg').text(errorMessages.disclaimer);
		if( $("#company-name").val() == 'Company Name' || $("#company-name").val() == '' ) $('#company-name').siblings('.error_msg').text(errorMessages.company);
	});
	
	
	// Survey page
	var totalOne;
	var totalTwo;
	
	$('input').on('keyup click blur', function(){
		var empty = $('input[type="number"]:not([readonly])').filter(function() {
			return this.value === "";
		});
		
		var negative = $('input[readonly]').filter(function() {
			return this.value < 0;
		});
		
		var repExecTotal = parseInt($('#repExecTotal').val()),
			repExecMen = parseInt($('#repExecMen').val()),
			repExecWomen = parseInt($('#repExecWomen').val()),
			turnExecAvgMen = parseInt($('#turnExecAvgMen').val()),
			turnExecJoinedMen = parseInt($('#turnExecJoinedMen').val()),
			turnExecLeftMen = parseInt($('#turnExecLeftMen').val()),
			turnExecAvgWomen = parseInt($('#turnExecAvgWomen').val()),
			turnExecJoinedWomen = parseInt($('#turnExecJoinedWomen').val()),
			turnExecLeftWomen = parseInt($('#turnExecLeftWomen').val());
		
		var repDirectTotal = parseInt($('#repDirectTotal').val()),
			repDirectMen = parseInt($('#repDirectMen').val()),
			repDirectWomen = parseInt($('#repDirectWomen').val()),
			turnDirectAvgMen = parseInt($('#turnDirectAvgMen').val()),
			turnDirectJoinedMen = parseInt($('#turnDirectJoinedMen').val()),
			turnDirectLeftMen = parseInt($('#turnDirectLeftMen').val()),
			turnDirectAvgWomen = parseInt($('#turnDirectAvgWomen').val()),
			turnDirectJoinedWomen = parseInt($('#turnDirectJoinedWomen').val()),
			turnDirectLeftWomen = parseInt($('#turnDirectLeftWomen').val());
		
		$('#turnExecAvgTotal').val(turnExecAvgMen + turnExecAvgWomen);
		$('#repExecMen').val( (turnExecAvgMen - turnExecLeftMen) + turnExecJoinedMen );
		$('#repExecWomen').val( (turnExecAvgWomen - turnExecLeftWomen) + turnExecJoinedWomen );
		$('#repExecTotal').val( ((turnExecAvgMen - turnExecLeftMen) + turnExecJoinedMen) + ((turnExecAvgWomen - turnExecLeftWomen) + turnExecJoinedWomen) );
		
		$('#turnDirectAvgTotal').val(turnDirectAvgMen + turnDirectAvgWomen);
		$('#repDirectMen').val( (turnDirectAvgMen - turnDirectLeftMen) + turnDirectJoinedMen );
		$('#repDirectWomen').val( (turnDirectAvgWomen - turnDirectLeftWomen) + turnDirectJoinedWomen );
		$('#repDirectTotal').val( ((turnDirectAvgMen - turnDirectLeftMen) + turnDirectJoinedMen) + ((turnDirectAvgWomen - turnDirectLeftWomen) + turnDirectJoinedWomen) );
		
		if( $('.last-year #prevRepExecMen').text() != '' && $('.last-year #prevRepExecWomen').text() != '' ) {
			if( turnExecAvgMen != $('.last-year #prevRepExecMen').text() || turnExecAvgWomen != $('.last-year #prevRepExecWomen').text() ) {
				$('.error_msg.prevYearExec').addClass('show');
			} else {
				$('.error_msg.prevYearExec').removeClass('show');
			}
		}
		
		if( $('.last-year #prevRepDirectMen').text() != '' || $('.last-year #prevRepDirectMen').text() != '' ) {
			if( turnDirectAvgMen != $('.last-year #prevRepDirectMen').text() || turnDirectAvgWomen != $('.last-year #prevRepDirectWomen').text() ) {
				$('.error_msg.prevYearDirect').addClass('show');
			} else {
				$('.error_msg.prevYearDirect').removeClass('show');
			}
		}
		
		if( negative.length ) {
			$('.error_msg.neg').show();
		} else {
			$('.error_msg.neg').hide();
		}

		if(empty.length || negative.length) {
			$('input.submit').prop('disabled', true);
		} else {
			$('input.submit').prop('disabled', false);
		}
	});
	
//	$('#share-info').on('click', function(){
//		if ( $(this).is(':checked') ) {
//			$('.submit-wrap .overlay').hide();
//		} else {
//			$('.submit-wrap .overlay').show();
//		}
//	});
	
	$(window).on('load', function(){
		
		var lastYearRepExecMen = $('.last-year #prevRepExecMen').text(),
			lastYearRepExecWomen = $('.last-year #prevRepExecWomen').text(),
			lastYearRepDirectMen = $('.last-year #prevRepDirectMen').text(),
			lastYearRepDirectWomen = $('.last-year #prevRepDirectWomen').text();
		
		if( lastYearRepExecMen != '' ) $('#turnExecAvgMen').val( lastYearRepExecMen ).attr('readonly', 'readonly');
		if( lastYearRepExecWomen != '' ) $('#turnExecAvgWomen').val( lastYearRepExecWomen ).attr('readonly', 'readonly');
		if( lastYearRepDirectMen != '' ) $('#turnDirectAvgMen').val( lastYearRepDirectMen ).attr('readonly', 'readonly');
		if( lastYearRepDirectWomen != '' ) $('#turnDirectAvgWomen').val( lastYearRepDirectWomen ).attr('readonly', 'readonly');
		if( lastYearRepExecMen != '' && lastYearRepExecWomen != '' ) $('#turnExecAvgTotal').attr('readonly', 'readonly');
		if( lastYearRepDirectMen != '' && lastYearRepDirectWomen != '' ) $('#turnDirectAvgTotal').attr('readonly', 'readonly');
		
		var repExecTotal = parseInt($('#repExecTotal').val()),
			repExecMen = parseInt($('#repExecMen').val()),
			repExecWomen = parseInt($('#repExecWomen').val()),
			turnExecAvgMen = parseInt($('#turnExecAvgMen').val()),
			turnExecJoinedMen = parseInt($('#turnExecJoinedMen').val()),
			turnExecLeftMen = parseInt($('#turnExecLeftMen').val()),
			turnExecAvgWomen = parseInt($('#turnExecAvgWomen').val()),
			turnExecJoinedWomen = parseInt($('#turnExecJoinedWomen').val()),
			turnExecLeftWomen = parseInt($('#turnExecLeftWomen').val());
		
		var repDirectTotal = parseInt($('#repDirectTotal').val()),
			repDirectMen = parseInt($('#repDirectMen').val()),
			repDirectWomen = parseInt($('#repDirectWomen').val()),
			turnDirectAvgMen = parseInt($('#turnDirectAvgMen').val()),
			turnDirectJoinedMen = parseInt($('#turnDirectJoinedMen').val()),
			turnDirectLeftMen = parseInt($('#turnDirectLeftMen').val()),
			turnDirectAvgWomen = parseInt($('#turnDirectAvgWomen').val()),
			turnDirectJoinedWomen = parseInt($('#turnDirectJoinedWomen').val()),
			turnDirectLeftWomen = parseInt($('#turnDirectLeftWomen').val());
		
		$('#turnExecAvgTotal').val(turnExecAvgMen + turnExecAvgWomen);
		$('#repExecMen').val( (turnExecAvgMen - turnExecLeftMen) + turnExecJoinedMen );
		$('#repExecWomen').val( (turnExecAvgWomen - turnExecLeftWomen) + turnExecJoinedWomen );
		$('#repExecTotal').val(repExecMen + repExecWomen);
		
		$('#turnDirectAvgTotal').val(turnDirectAvgMen + turnDirectAvgWomen);
		$('#repDirectMen').val( (turnDirectAvgMen - turnDirectLeftMen) + turnDirectJoinedMen );
		$('#repDirectWomen').val( (turnDirectAvgWomen - turnDirectLeftWomen) + turnDirectJoinedWomen );
		$('#repDirectTotal').val(repDirectMen + repDirectWomen);
		
		var empty = $('input[type="number"]').filter(function() {
			return this.value === "";
		});

		if(empty.length) {
			$('input.submit').prop('disabled', true);
		} else {
			$('input.submit').prop('disabled', false);
		}
		
		if ( $('#share-info').is(':checked') ) {
			$('.submit-wrap .overlay').hide();
		} else {
			$('.submit-wrap .overlay').show();
		}
	});

	function limitText(field, maxChar){
		var ref = $(field),
			val = ref.val();
		if ( val.length >= maxChar ){
			ref.val(function() {
				return val.substr(0, maxChar);       
			});
		}
	}
	
	$('input.save').click(function(){
		$('.popUp').show();
	});
	
	$('.overlay-two').click(function(){
		$('.confirmBox').show();
	});
	
	$('.submit.close').click(function(){
		$('.confirmBox').hide();
	});
	
	$('#share-info').on('click', function(){
		if ($('#share-info').is(':checked')) {
			$('.overlay-two').hide();
		} else {
			$('.overlay-two').show();
		}
	});
	
	$('button.with-consent').on('click', function(){
		$('#share-info').prop('checked', true);
	});
	
	
	// RESET PASS
	var emptyFields = true;
	var passCheck = false;
	var passStr = false;

	$('input').on('keyup blur', function(){
		var inputVal = $(this).val();

		if( inputVal.length == 0 ) {
			$(this).addClass('fail');
		} else {
			$(this).removeClass('fail');
			$(this).next('.error_msg').text('');
		}

		if( $(this).is('#pass1') ) {
			function hasNumber(myString) {
			  return /\d/.test(myString);
			}
			
			if( $('#pass2').val() == inputVal ) {
				$(this).next('.error_msg').text('');
				passCheck = true;
			} else {
				$(this).next('.error_msg').text("Passwords don't match");
				passCheck = false;
			}
			
			if( inputVal.length >= 7 && /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9!@#\$%\^\&*\)\(+=._-]+)$/.test(inputVal) ) {
				$(this).next('.error_msg').text('');
				passStr = true;
			} else {
				$(this).next('.error_msg').text('Make sure your password meets the minimum requirements');
				passStr = false;
			}
		}

		if( $(this).is('#pass2') ) {
			if( $('#pass1').val() == inputVal ) {
				$(this).next('.error_msg').text('');
				passCheck = true;
			} else {
				$(this).next('.error_msg').text("Passwords don't match");
				passCheck = false;
			}
		}

		var empty = $('input').filter(function() {
			return this.value === "";
		});

		if(empty.length) {
			emptyFields = true;
		} else {
			emptyFields = false;
		}
	});

	$('input').on('keyup blur', function(){
		if( !emptyFields && passCheck && passStr ) {
			$('#resetpass-button').prop('disabled', false);
		} else {
			$('#resetpass-button').prop('disabled', true);
		}
	});
	
	$('input').addClass('fail');
	
	$('.overlay').click(function(){
		$('.fail:not(#disclaimer, #company-name)').siblings('.error_msg').text(errorMessages.empty);
		if( !$('input#disclaimer').is(':checked') ) $('#disclaimer').siblings('.error_msg').text(errorMessages.disclaimer);
		if( $("#company-name").val() == 'Company Name' || $("#company-name").val() == '' ) $('#company-name').siblings('.error_msg').text(errorMessages.company);
	});
});