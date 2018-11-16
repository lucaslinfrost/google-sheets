<?php
  $graph = array(
    '拜倫陣地' => array('拜倫街','馬雷爾爆炸中心地'),
    '拜倫街' => array('米謝爾奈平原','拜倫陣地'),
    '米謝爾奈平原' => array('洛庫庫礦山之村','拜倫街'),
    '洛庫庫礦山之村' => array('米謝爾奈平原','洛庫庫坑道','洛恩法山脈'),
    '洛庫庫坑道' => array('洛庫庫礦山之村'),
    '洛恩法山脈' => array('洛庫庫街','洛庫庫礦山之村','洛恩法洞窟','洛庫庫風洞'),
    '洛庫庫風洞' => array('洛恩法山脈','迪魯村','洛庫庫風洞・下層'),
    '洛庫庫風洞・下層' => array('洛庫庫風洞'),
    '洛恩法洞窟' => array('洛恩法山脈','洛恩法山脈・山頂'),
    '洛恩法山脈・山頂' => array('洛恩法洞窟'),
    '迪魯村' => array('洛庫庫風洞'),
    '洛庫庫街' => array('洛恩法山脈','魔女狩獵之森','洛庫庫平原','酒吧 月亮守護者','洛庫庫街 占卜屋','洛庫庫街 鐵匠鋪'),
    '酒吧 月亮守護者' => array('洛庫庫街'),
    '洛庫庫街 占卜屋' => array('洛庫庫街'),
    '洛庫庫街 鐵匠鋪' => array('洛庫庫街'),
    '魔女狩獵之森' => array('麗塔的家','洛庫庫街'),
    '麗塔的家' => array('魔女狩獵之森'),
    '洛庫庫平原' => array('洛庫庫街','被遺忘的洞窟','薩烏格沼澤'),
    '被遺忘的洞窟' => array('洛庫庫平原','被遺忘的洞窟B1'),
    '被遺忘的洞窟B1' => array('被遺忘的洞窟','被遺忘的洞窟B2'),
    '被遺忘的洞窟B2' => array('被遺忘的洞窟B1'),
    '薩烏格沼澤' => array('洛庫庫平原','內吉木沼澤','特裏拖之森','龍王的浮島'),
    '內吉木沼澤' => array('薩烏格沼澤','扎魯巴平原'),
    '特裏拖之森' => array('薩烏格沼澤','月之民的村子','灼熱隧道'),
    '月之民的村子' => array('特裏拖之森','暗之領域'),
    '灼熱隧道' => array('特裏拖之森','灼熱隧道・B1'),
    '灼熱隧道・B1' => array('灼熱隧道','灼熱隧道・B2'),
    '灼熱隧道・B2' => array('灼熱隧道・B1','灼熱隧道・火山口'),
    '灼熱隧道・火山口' => array('灼熱隧道・B2'),
    '龍王的浮島' => array('薩烏格沼澤','龍王的浮島・F2'),
    '龍王的浮島・F2' => array('龍王的浮島','龍王的浮島・F3'),
    '龍王的浮島・F3' => array('龍王的浮島・F2','龍王的浮島・謁見之間'),
    '龍王的浮島・謁見之間' => array('龍王的浮島・F3'),
    '暗之領域' => array('月之民的村子','暗之荒野'),
    '暗之荒野' => array('暗之領域','暗之館・1層'),
    '暗之館・1層' => array('暗之荒野','暗之館・2層'),
    '暗之館・2層' => array('暗之館・1層','暗之館・3層'),
    '暗之館・3層' => array('暗之館・2層','暗之館・大廳'),
    '暗之館・大廳' => array('暗之館・3層','暗之城'),
    '暗之城' => array('月之民的村子','暗之城(座標78.114)'),
    '暗之城(座標78.114)' => array('暗之城','暗之城(座標227.125)'),
    '暗之城(座標227.125)' => array('暗之城(座標78.114)','暗之城(座標90.213)'),
    '暗之城(座標90.213)' => array('暗之城(座標227.125)','暗之城(座標233.66)'),
    '暗之城(座標233.66)' => array('暗之城(座標90.213)','暗之城(座標180.218往下跳)'),
    '暗之城(座標180.218往下跳)' => array('暗之城(座標233.66)','暗之城・3層(座標112.6)'),
    '暗之城・3層(座標112.6)' => array('暗之城(座標180.218往下跳)','暗之城・2層(座標186.125)'),
    '暗之城・2層(座標186.125)' => array('暗之城・3層(座標112.6)','暗之城・3層(座標65.173)'),
    '暗之城・3層(座標65.173)' => array('暗之城・2層(座標186.125)','暗之城・3層(座標137.138)'),
    '暗之城・3層(座標137.138)' => array('暗之城・3層(座標65.173)','暗之城・3層(座標174.113)'),
    '暗之城・3層(座標174.113)' => array('暗之城・3層(座標137.138)','暗之城・3層(座標102.210)'),
    '暗之城・3層(座標102.210)' => array('暗之城・3層(座標174.113)','暗之城・3層(座標114.48)'),
    '暗之城・3層(座標114.48)' => array('暗之城・3層(座標102.210)','暗之城・玉座之間'),
    '暗之城・玉座之間' => array('暗之城・3層(座標114.48)','月之民的村子'),
    '扎魯巴平原' => array('內吉木沼澤','首都索菲亞'),
    '首都索菲亞' => array('扎魯巴平原','索菲亞郊外','落星山街道','索菲斯大教堂','酒吧・女神之泉','首都索菲亞・執政官邸'),
    '索菲斯大教堂' => array('首都索菲亞'),
    '酒吧・女神之泉' => array('首都索菲亞'),
    '首都索菲亞・執政官邸' => array('首都索菲亞','首都索菲亞・公會'),
    '首都索菲亞・公會' => array('首都索菲亞・執政官邸'),
    '索菲亞郊外' => array('首都索菲亞','克魯達峰'),
    '克魯達峰' => array('索菲亞郊外','尼迪亞海岸'),
    '尼迪亞海岸' => array('克魯達峰','風之洞穴・1樓','伊洛島'),
    '風之洞穴・1樓' => array('尼迪亞海岸','風之洞穴・2樓'),
    '風之洞穴・2樓' => array('風之洞穴・1樓','風之洞穴・3樓'),
    '風之洞穴・3樓' => array('風之洞穴・2樓','風之洞穴・4樓'),
    '風之洞穴・4樓' => array('風之洞穴・3樓','風之洞穴・深部'),
    '風之洞穴・深部' => array('風之洞穴・4樓'),
    '伊洛島' => array('尼迪亞海岸','古力埃要塞・F1'),
    '古力埃要塞・F1' => array('伊洛島','古力埃要塞・F2'),
    '古力埃要塞・F2' => array('古力埃要塞・F1','古力埃要塞・F3'),
    '古力埃要塞・F3' => array('古力埃要塞・F2','古力埃要塞・F4'),
    '古力埃要塞・F4' => array('古力埃要塞・F3','古力埃要塞・F5'),
    '古力埃要塞・F5' => array('古力埃要塞・F4','古力埃要塞・F6'),
    '古力埃要塞・F6' => array('古力埃要塞・F5','古力埃要塞・最頂層'),
    '古力埃要塞・最頂層' => array('古力埃要塞・F6'),
    '落星山街道' => array('首都索菲亞','羅魯巴平原'),
    '羅魯巴平原' => array('落星山街道','巨木洞窟・F1','卡盧艾湖'),
    '巨木洞窟・F1' => array('羅魯巴平原','巨木洞窟・F2'),
    '巨木洞窟・F2' => array('巨木洞窟・F1','巨木洞窟・F3'),
    '巨木洞窟・F3' => array('巨木洞窟・F2','巨木洞窟・F4'),
    '巨木洞窟・F4' => array('巨木洞窟・F3','巨木洞窟・樹頂'),
    '巨木洞窟・樹頂' => array('巨木洞窟・F4'),
    '卡盧艾湖' => array('羅魯巴平原','扎魯姆沙漠','特希安高原'),
    '扎魯姆沙漠' => array('卡盧艾湖','冰之塔'),
    '冰之塔' => array('扎魯姆沙漠','冰之塔・2F'),
    '冰之塔・2F' => array('冰之塔','冰之塔・3F'),
    '冰之塔・3F' => array('冰之塔・2F','冰之塔・4F'),
    '冰之塔・4F' => array('冰之塔・3F','冰之塔・5F'),
    '冰之塔・5F' => array('冰之塔・4F','冰之塔・頂樓'),
    '冰之塔・頂樓' => array('冰之塔・5F'),
    '特希安高原' => array('卡盧艾湖','維波街'),
    '維波街' => array('特希安高原','康特里諾沙漠'),
    '康特里諾沙漠' => array('維波街','希古米溪谷・北部'),
    '希古米溪谷・北部' => array('康特里諾沙漠','希古米溪谷・山腰'),
    '希古米溪谷・山腰' => array('希古米溪谷・北部','希古米溪谷・谷底','齊露弗原野'),
    '希古米溪谷・谷底' => array('希古米溪谷・山腰','希古米溪谷・地下'),
    '希古米溪谷・地下' => array('希古米溪谷・谷底'),
    '齊露弗原野' => array('希古米溪谷・山腰','瓦吉羅荒原'),
    '瓦吉羅荒原' => array('齊露弗原野','庫雷亞街'),
    '庫雷亞街' => array('瓦吉羅荒原','茵潔居留地','盜賊的活動地'),
    '茵潔居留地' => array('庫雷亞街','茵潔墓群・深處'),
    '茵潔墓群・深處' => array('茵潔居留地','茵潔墓群・最深處'),
    '茵潔墓群・最深處' => array('茵潔墓群・深處'),
    '盜賊的活動地' => array('庫雷亞街','蓋斯特村','托盧巴斯郊區'),
    '蓋斯特村' => array('盜賊的活動地','蓋斯特村小巷'),
    '蓋斯特村小巷' => array('蓋斯特村','蓋斯特村・教堂前'),
    '蓋斯特村・教堂前' => array('蓋斯特村・小巷'),
    '托盧巴斯郊區' => array('盜賊的活動地','庫洛奈街道'),
    '庫洛奈街道' => array('托盧巴斯郊區','首都薩特利卡','米斯魯那山'),
    '米斯魯那山' => array('庫洛奈街道','魔境摩魯迦'),
    '魔境摩魯迦' => array('米斯魯那山','魔境摩魯迦・第2層'),
    '魔境摩魯迦・第2層' => array('魔境摩魯迦','魔境摩魯迦・第3層'),
    '魔境摩魯迦・第3層' => array('魔境摩魯迦・第2層','魔境摩魯迦・發生層'),
    '魔境摩魯迦・發生層' => array('魔境摩魯迦・第3層'),
    '首都薩特利卡' => array('庫洛奈街道','首都薩特利卡・總統府','酒吧・狐狸巢','塔納斯沙漠','貝路諾沙地','雷德鹽湖'),
    '首都薩特利卡・總統府' => array('首都薩特利卡'),
    '酒吧・狐狸巢' => array('首都薩特利卡'),
    '貝路諾沙地' => array('首都薩特利卡','艾裡烏木遺跡','沙龍的床'),
    '沙龍的床' => array('貝路諾沙地','沙龍的床・深處'),
    '沙龍的床・深處' => array('沙龍的床'),
    '塔納斯沙漠' => array('首都薩特利卡','塔納斯礦山'),
    '塔納斯礦山' => array('塔納斯沙漠'),
    '雷德鹽湖' => array('首都薩特利卡','艾裡烏木遺跡'),
    '艾裡烏木遺跡' => array('雷德鹽湖','貝路諾沙地','庫雷文迴廊','澤布魯之塔・1層'),
    '庫雷文迴廊' => array('艾裡烏木遺跡','特奧斯郊區'),
    '澤布魯之塔・1層' => array('艾裡烏木遺跡','澤布魯之塔・2層'),
    '澤布魯之塔・2層' => array('澤布魯之塔・1層','澤布魯之塔・3層'),
    '澤布魯之塔・3層' => array('澤布魯之塔・2層','澤布魯之塔・4層'),
    '澤布魯之塔・4層' => array('澤布魯之塔・3層','澤布魯之塔・最頂層'),
    '澤布魯之塔・最頂層' => array('澤布魯之塔・4層'),
    '特奧斯郊區' => array('庫雷文迴廊','澤魯希姆之地'),
    '澤魯希姆之地' => array('特奧斯郊區','艾路菲山脈・路口'),
    '艾路菲山脈・路口' => array('澤魯希姆之地','艾路菲山脈'),
    '艾路菲山脈' => array('艾路菲山脈・路口','艾路菲山脈・山頂'),
    '艾路菲山脈・山頂' => array('艾路菲山脈','艾恩之森'),
    '艾恩之森' => array('艾路菲山脈・山頂','莫斯海雷瘤界'),
    '莫斯海雷瘤界' => array('艾恩之森','莫斯海雷瘤界・深部','阿魯托雷地區'),
    '莫斯海雷瘤界・深部' => array('莫斯海雷瘤界'),
    '阿魯托雷地區' => array('莫斯海雷瘤界','拉比蘭斯地區・西部'),
    '拉比蘭斯地區・西部' => array('阿魯托雷地區','拉比蘭斯地區・東部'),
    '拉比蘭斯地區・東部' => array('拉比蘭斯地區・西部','狄其特地區'),
    '狄其特地區' => array('拉比蘭斯地區・東部','首都埃魯巴'),
    '首都埃魯巴' => array('狄其特地區','比澤恩森林地區','首都埃魯巴・王宮','首都埃魯巴・議事廳','首都埃魯巴・研究院','巴斯緹路地區・區域1'),
    '比澤恩森林地區' => array('首都埃魯巴','比澤恩森林地區・深部'),
    '比澤恩森林地區・深部' => array('比澤恩森林地區'),
    '首都埃魯巴・王宮' => array('首都埃魯巴','特魯托森林','首都埃魯巴・天界','博德拉格洞穴・區域1'),
    '首都埃魯巴・天界' => array('首都埃魯巴'),
    '首都埃魯巴・議事廳' => array('首都埃魯巴'),
    '首都埃魯巴・研究院' => array('首都埃魯巴','伊恩奈邦遺跡','安澤伊茲迷宮・地下4層','哈迪斯迷宮・區域1'),
    '伊恩奈邦遺跡' => array('首都埃魯巴・研究院','伊恩奈邦遺跡・地下2層'),
    '伊恩奈邦遺跡・地下2層' => array('伊恩奈邦遺跡','伊恩奈邦遺跡・地下3層'),
    '伊恩奈邦遺跡・地下3層' => array('伊恩奈邦遺跡・地下2層','伊恩奈邦遺跡・地下4層'),
    '伊恩奈邦遺跡・地下4層' => array('伊恩奈邦遺跡・地下3層','伊恩奈邦遺跡・最深處'),
    '伊恩奈邦遺跡・最深處' => array('伊恩奈邦遺跡・地下4層','安澤伊茲迷宮・地下1層'),
    '安澤伊茲迷宮・地下1層' => array('伊恩奈邦遺跡・最深處','安澤伊茲迷宮・地下2層'),
    '安澤伊茲迷宮・地下2層' => array('安澤伊茲迷宮・地下1層','安澤伊茲迷宮・地下3層'),
    '安澤伊茲迷宮・地下3層' => array('安澤伊茲迷宮・地下2層','安澤伊茲迷宮・地下4層'),
    '安澤伊茲迷宮・地下4層' => array('安澤伊茲迷宮・地下3層','文貝魯特迷宮・地下1層'),
    '文貝魯特迷宮・地下1層' => array('安澤伊茲迷宮・地下4層','文貝魯特迷宮・地下2層'),
    '文貝魯特迷宮・地下2層' => array('文貝魯特迷宮・地下1層','霍蒙庫魯斯村'),
    '霍蒙庫魯斯村' => array('文貝魯特迷宮・地下2層'),
    '哈迪斯迷宮・區域1' => array('首都埃魯巴・研究院','哈迪斯迷宮・區域2'),
    '哈迪斯迷宮・區域2' => array('哈迪斯迷宮・區域1','哈迪斯迷宮・區域3'),
    '哈迪斯迷宮・區域3' => array('哈迪斯迷宮・區域2','佛古拜魯城'),
    '佛古拜魯城' => array('哈迪斯迷宮・區域3','首都埃魯巴・研究院'),
    '博德拉格洞穴・區域1' => array('首都埃魯巴・王宮','博德拉格洞穴・區域2'),
    '博德拉格洞穴・區域2' => array('博德拉格洞穴・區域1','博德拉格洞穴・區域3'),
    '博德拉格洞穴・區域3' => array('博德拉格洞穴・區域2','博德拉格洞穴・最深處'),
    '博德拉格洞穴・最深處' => array('博德拉格洞穴・區域3'),
    '巴斯緹路地區・區域1' => array('首都埃魯巴','巴斯緹路地區・區域2'),
    '巴斯緹路地區・區域2' => array('巴斯緹路地區・區域1','巴斯緹路地區・區域3'),
    '巴斯緹路地區・區域3' => array('巴斯緹路地區・區域2','巴斯緹路地區・區域4'),
    '巴斯緹路地區・區域4' => array('巴斯緹路地區・區域3','哈無菲港'),
    '哈無菲港' => array('巴斯緹路地區・區域4','賈娜吉海岸','斯帕加斯港','菲力哲海岸'),
    '賈娜吉海岸' => array('哈無菲港','米莎卡石門・區域1','斯帕加斯港','米那烏拉街'),
    '米莎卡石門・區域1' => array('賈娜吉海岸','米莎卡石門・區域2'),
    '米莎卡石門・區域2' => array('米莎卡石門・區域1','米莎卡石門・區域3'),
    '米莎卡石門・區域3' => array('米莎卡石門・區域2','米莎卡石門・區域4'),
    '米莎卡石門・區域4' => array('米莎卡石門・區域3'),
    '米那烏拉街' => array('水際城','賈娜吉海岸','巖動寺・F1','米娜烏拉街的鐵匠鋪','米克馬裡之原'),
    '水際城' => array('米那烏拉街','奇克斯之森・區域1'),
    '奇克斯之森・區域1' => array('水際城','奇克斯之森・區域2'),
    '奇克斯之森・區域2' => array('奇克斯之森・區域1','奇克斯之森・區域3'),
    '奇克斯之森・區域3' => array('奇克斯之森・區域2','奇克斯之森・最深處'),
    '奇克斯之森・最深處' => array('奇克斯之森・區域3'),
    '米娜烏拉街的鐵匠鋪' => array('米那烏拉街'),
    '巖動寺・F1' => array('米那烏拉街','巖動寺・F2'),
    '巖動寺・F2' => array('巖動寺・F1','巖動寺・F3'),
    '巖動寺・F3' => array('巖動寺・F2','巖動寺・深處'),
    '巖動寺・深處' => array('巖動寺・F3'),
    '米克馬裡之原' => array('米那烏拉街','頑固工匠之館','山蜂之村'),
    '頑固工匠之館' => array('米克馬裡之原','貞慶的鍛刀廠'),
    '貞慶的鍛刀廠' => array('頑固工匠之館'),
    '山蜂之村' => array('米克馬裡之原','阿馬基期城'),
    '阿馬基期城' => array('山蜂之村','阿馬基期城・2層'),
    '阿馬基期城・2層' => array('阿馬基期城','阿馬基期城・3層'),
    '阿馬基期城・3層' => array('阿馬基期城・2層','阿馬基期城・頂樓塔'),
    '阿馬基期城・頂樓塔' => array('阿馬基期城・3層','阿馬基期城・3層(峰永的另一邊)'),
    '阿馬基期城・3層(峰永的另一邊)' => array('阿馬基期城・頂樓塔','阿馬基期城・天守閣旁'),
    '阿馬基期城・天守閣旁' => array('阿馬基期城・3層(峰永的另一邊)'),
    '斯帕加斯港' => array('哈無菲港','賈娜吉海岸','阿魯加歐特監獄','鄔伏平原','酒吧 彩虹蝶','諾基商店'),
    '酒吧 彩虹蝶' => array('斯帕加斯港'),
    '諾基商店' => array('斯帕加斯港'),
    '阿魯加歐特監獄' => array('斯帕加斯港','阿魯加歐特監獄・地下1層'),
    '阿魯加歐特監獄・地下1層' => array('阿魯加歐特監獄','阿魯加歐特監獄・地下2層'),
    '阿魯加歐特監獄・地下2層' => array('阿魯加歐特監獄・地下1層','阿魯加歐特監獄・最下層'),
    '阿魯加歐特監獄・最下層' => array('阿魯加歐特監獄・地下2層'),
    '鄔伏平原' => array('斯帕加斯港','裘裡歐魯特・區域1','齊魯木裡高原'),
    '裘裡歐魯特・區域1' => array('鄔伏平原','裘裡歐魯特・區域2'),
    '裘裡歐魯特・區域2' => array('裘裡歐魯特・區域1','裘裡歐魯特・區域3'),
    '裘裡歐魯特・區域3' => array('裘裡歐魯特・區域2','裘裡歐魯特・腹地'),
    '裘裡歐魯特・腹地' => array('裘裡歐魯特・區域3'),
    '齊魯木裡高原' => array('鄔伏平原','帝羅路特・區域1','伊弗摩魯特集落'),
    '帝羅路特・區域1' => array('齊魯木裡高原','帝羅路特・區域2'),
    '帝羅路特・區域2' => array('帝羅路特・區域1','帝羅路特・區域3'),
    '帝羅路特・區域3' => array('帝羅路特・區域2','帝羅路特・最深處'),
    '帝羅路特・最深處' => array('帝羅路特・區域3'),
    '伊弗摩魯特集落' => array('齊魯木裡高原','霍盧托恩山','艾利路達恩沙漠'),
    '霍盧托恩山' => array('伊弗摩魯特集落','霍盧托恩山・區域2'),
    '霍盧托恩山・區域2' => array('霍盧托恩山','霍盧托恩山・區域3'),
    '霍盧托恩山・區域3' => array('霍盧托恩山・區域2','霍盧托恩山・山頂上'),
    '霍盧托恩山・山頂上' => array('霍盧托恩山・區域3'),
    '艾利路達恩沙漠' => array('伊弗摩魯特集落','工業城市雷格斯・1層','諾托魯平原'),
    '工業城市雷格斯・1層' => array('艾利路達恩沙漠','工業城市雷格斯・2層'),
    '工業城市雷格斯・2層' => array('工業城市雷格斯・1層','工業城市雷格斯・3層'),
    '工業城市雷格斯・3層' => array('工業城市雷格斯・2層','工業城市雷格斯・控制室'),
    '工業城市雷格斯・控制室' => array('工業城市雷格斯・3層'),
    '諾托魯平原' => array('艾利路達恩沙漠','戈洛格山脈・區域1','羅古拉斯郊區','斯魯比努斯要塞・區域1'),
    '戈洛格山脈・區域1' => array('諾托魯平原','戈洛格山脈・區域2'),
    '戈洛格山脈・區域2' => array('戈洛格山脈・區域1','戈洛格山脈・區域3'),
    '戈洛格山脈・區域3' => array('戈洛格山脈・區域2','戈洛格山脈・山頂上'),
    '戈洛格山脈・山頂上' => array('戈洛格山脈・區域3'),
    '羅古拉斯郊區' => array('諾托魯平原','帝都羅古拉斯・區域1'),
    '帝都羅古拉斯・區域1' => array('羅古拉斯郊區','帝都羅古拉斯・區域2'),
    '帝都羅古拉斯・區域2' => array('帝都羅古拉斯・區域1','帝都羅古拉斯・區域3'),
    '帝都羅古拉斯・區域3' => array('帝都羅古拉斯・區域2','梅扎露娜宮殿前'),
    '梅扎露娜宮殿前' => array('帝都羅古拉斯・區域3','梅扎露娜宮殿・F1'),
    '梅扎露娜宮殿・F1' => array('梅扎露娜宮殿前','梅扎露娜宮殿・F2'),
    '梅扎露娜宮殿・F2' => array('梅扎露娜宮殿・F1','梅扎露娜宮殿・F3'),
    '梅扎露娜宮殿・F3' => array('梅扎露娜宮殿・F2','梅扎露娜宮殿・神力爐'),
    '梅扎露娜宮殿・神力爐' => array('梅扎露娜宮殿・F3'),
    '斯魯比努斯要塞・區域1' => array('諾托魯平原','斯魯比努斯要塞・區域2'),
    '斯魯比努斯要塞・區域2' => array('斯魯比努斯要塞・區域1','斯魯比努斯要塞・區域3'),
    '斯魯比努斯要塞・區域3' => array('斯魯比努斯要塞・區域2','斯魯比努斯要塞・區域4'),
    '斯魯比努斯要塞・區域4' => array('斯魯比努斯要塞・區域3','馬雷爾爆炸中心地'),
    '馬雷爾爆炸中心地' => array('拜倫陣地','斯魯比努斯要塞・區域4','巴魯諾簡易工廠','眾神之塔・1階','班谷平原'),
    '巴魯諾簡易工廠' => array('馬雷爾爆炸中心地','巴魯諾之丘・山頂'),
    '巴魯諾之丘・山頂' => array('巴魯諾簡易工廠'),
    '眾神之塔・1階' => array('馬雷爾爆炸中心地','眾神之塔・2階'),
    '眾神之塔・2階' => array('眾神之塔・1階','生命至聖所','眾神之塔・3階'),
    '生命至聖所' => array('眾神之塔・2階'),
    '眾神之塔・3階' => array('眾神之塔・2階','眾神之塔・4階'),
    '眾神之塔・4階' => array('眾神之塔・3階','火之至聖所','水之至聖所','風之至聖所','大地至聖所','眾神之塔・5階'),
    '火之至聖所' => array('眾神之塔・4階'),
    '水之至聖所' => array('眾神之塔・4階'),
    '風之至聖所' => array('眾神之塔・4階'),
    '大地至聖所' => array('眾神之塔・4階'),
    '眾神之塔・5階' => array('眾神之塔・4階','眾神之塔・6階'),
    '眾神之塔・6階' => array('眾神之塔・5階','智慧至聖所','義之至聖所','和平至聖所','慈愛至聖所','眾神之塔・7階'),
    '智慧至聖所' => array('眾神之塔・6階'),
    '義之至聖所' => array('眾神之塔・6階'),
    '和平至聖所' => array('眾神之塔・6階'),
    '慈愛至聖所' => array('眾神之塔・6階'),
    '眾神之塔・7階' => array('眾神之塔・6階','眾神之塔・8階'),
    '眾神之塔・8階' => array('眾神之塔・7階','戰之至聖所','暗之至聖所','眾神之塔・9階'),
    '戰之至聖所' => array('眾神之塔・8階'),
    '暗之至聖所' => array('眾神之塔・8階'),
    '眾神之塔・9階' => array('眾神之塔・8階','眾神之塔・10階'),
    '眾神之塔・10階' => array('眾神之塔・9階','天空至聖所'),
    '天空至聖所' => array('眾神之塔・10階'),
    '班谷平原' => array('馬雷爾爆炸中心地','吉姆威山 第一區域','德拉夫伯格・異邦人街','莫庫斯密林'),
    '吉姆威山 第一區域' => array('班谷平原','吉姆威山 第二區域'),
    '吉姆威山 第二區域' => array('吉姆威山 第一區域','吉姆威山 第三區域'),
    '吉姆威山 第三區域' => array('吉姆威山 第二區域','吉姆威 山頂'),
    '吉姆威 山頂' => array('吉姆威山 第三區域'),
    '德拉夫伯格・異邦人街' => array('班谷平原','酒館・龍王之樽','德拉夫伯格・鐵匠鋪','德拉夫伯格・龍人街','艾坤道街道','艾吾吉的森林','木白來山谷'),
    '酒館・龍王之樽' => array('德拉夫伯格・異邦人街'),
    '德拉夫伯格・鐵匠鋪' => array('德拉夫伯格・異邦人街'),
    '德拉夫伯格・龍人街' => array('德拉夫伯格・異邦人街','德拉夫伯格・長老們'),
    '德拉夫伯格・長老們' => array('德拉夫伯格・龍人街'),
    '艾坤道街道' => array('德拉夫伯格・異邦人街','扎馬尼遺跡・區域1','馬奈諾村'),
    '扎馬尼遺跡・區域1' => array('艾坤道街道','扎馬尼遺跡・區域2'),
    '扎馬尼遺跡・區域2' => array('扎馬尼遺跡・區域1','扎馬尼遺跡・區域3'),
    '扎馬尼遺跡・區域3' => array('扎馬尼遺跡・區域2','扎馬尼遺跡・最深處'),
    '扎馬尼遺跡・最深處' => array('扎馬尼遺跡・區域3'),
    '馬奈諾村' => array('艾坤道街道','瑪貢迦要塞・地上'),
    '瑪貢迦要塞・地上' => array('馬奈諾村','瑪貢迦要塞・地下'),
    '瑪貢迦要塞・地下' => array('瑪貢迦要塞・地上','瑪貢迦要塞'),
    '瑪貢迦要塞' => array('瑪貢迦要塞・地下','瑪貢迦要塞・最上層'),
    '瑪貢迦要塞・最上層' => array('瑪貢迦要塞'),
    '艾吾吉的森林' => array('德拉夫伯格・異邦人街','前線基地・區域1','上野山谷'),
    '前線基地・區域1' => array('艾吾吉的森林','前線基地・區域2'),
    '前線基地・區域2' => array('前線基地・區域1','前線基地・區域3'),
    '前線基地・區域3' => array('前線基地・區域2','前線基地・最深處'),
    '前線基地・最深處' => array('前線基地・區域3'),
    '上野山谷' => array('艾吾吉的森林','卡索克山地','多拉夫特魯','庫雷魯教堂街'),
    '卡索克山地' => array('上野山谷','哈里布濕地・區域1','卡布裡地溝・區域1'),
    '哈里布濕地・區域1' => array('卡索克山地','哈里布濕地・區域2'),
    '哈里布濕地・區域2' => array('哈里布濕地・區域1','哈里布濕地・區域3'),
    '哈里布濕地・區域3' => array('哈里布濕地・區域2','哈里布濕地・最深處'),
    '哈里布濕地・最深處' => array('哈里布濕地・區域3'),
    '卡布裡地溝・區域1' => array('卡索克山地','卡布裡地溝・區域2'),
    '卡布裡地溝・區域2' => array('卡布裡地溝・區域1','卡布裡地溝・區域3'),
    '卡布裡地溝・區域3' => array('卡布裡地溝・區域2','卡布裡地溝・最深處'),
    '卡布裡地溝・最深處' => array('卡布裡地溝・區域3','諾耶巴爾・區域1'),
    '諾耶巴爾・區域1' => array('卡布裡地溝・最深處','諾耶巴爾・區域2'),
    '諾耶巴爾・區域2' => array('諾耶巴爾・區域1','諾耶巴爾・區域3'),
    '諾耶巴爾・區域3' => array('諾耶巴爾・區域2','諾耶巴爾・最深處'),
    '諾耶巴爾・最深處' => array('諾耶巴爾・區域3'),
    '多拉夫特魯' => array('上野山谷','龍帝神殿'),
    '龍帝神殿' => array('多拉夫特魯','龍帝神殿・最深處'),
    '龍帝神殿・最深處' => array('龍帝神殿'),
    '庫雷魯教堂街' => array('上野山谷','庫雷伊魯教堂街・大教堂','庫雷魯教皇區・武器庫','庫雷魯教皇區・外交部','茶話館・瑪尼卡','巴裡克森林'),
    '庫雷伊魯教堂街・大教堂' => array('庫雷魯教堂街'),
    '庫雷魯教皇區・武器庫' => array('庫雷魯教堂街'),
    '庫雷魯教皇區・外交部' => array('庫雷魯教堂街'),
    '茶話館・瑪尼卡' => array('庫雷魯教堂街'),
    '巴裡克森林' => array('庫雷魯教堂街','修道院遺跡・區域1','阿西裡特別區'),
    '修道院遺跡・區域1' => array('巴裡克森林','修道院遺跡・區域2'),
    '修道院遺跡・區域2' => array('修道院遺跡・區域1','修道院遺跡・區域3'),
    '修道院遺跡・區域3' => array('修道院遺跡・區域2','修道院遺跡・禮拜堂'),
    '修道院遺跡・禮拜堂' => array('修道院遺跡・區域3'),
    '阿西裡特別區' => array('巴裡克森林','生命之樹・區域1'),
    '生命之樹・區域1' => array('阿西裡特別區','生命之樹・區域2'),
    '生命之樹・區域2' => array('生命之樹・區域1','生命之樹・區域3'),
    '生命之樹・區域3' => array('生命之樹・區域2','生命之樹・最上部'),
    '生命之樹・最上部' => array('生命之樹・區域3'),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
    '' => array('',''),
);
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            $code = explode('#', $message['text']);
            
        break;
        }
}

class Graph
{
    protected $graph;
    protected $visited = array();
    public function __construct($graph) {
        $this->graph = $graph;
    }
public function leastHops($origin, $destination) {
        // mark all nodes as unvisited
        foreach ($this->graph as $key => $vertex) {
            $this->visited[$key] = false;
        }
        // create an empty queue
        $q = new SplQueue();
      
        // enqueue the origin vertex and mark as visited
        $q->enqueue($origin);
        $this->visited[$origin] = true;
      
        // an array stack to track the path back from each node
        $path = array();
        $path[$origin] = new SplDoublyLinkedList();
        $path[$origin]->setIteratorMode(
            SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP
        );
      
        $path[$origin]->push($origin);
      
        $found = false;
        // while queue is not empty and destination not found
        while (!$q->isEmpty() && $q->bottom() != $destination) {
            $t = $q->dequeue();
      
            if (!empty($this->graph[$t])) {
                // for each adjacent neighbor
                foreach ($this->graph[$t] as $vertex) {
                    if (!$this->visited[$vertex]) {
                        // if not yet visited, enqueue vertex and mark as visited
                        $q->enqueue($vertex);
                        $this->visited[$vertex] = true;
                        // add vertex to current node path
                        $path[$vertex] = clone $path[$t];
                        $path[$vertex]->push($vertex);
                    }
                }
            }
        }
        
        if (isset($path[$destination])) {
            $mapno = count($path[$destination]) - 1;
                " 個地圖\n";
$title = "從【".$origin."】
到【".$destination."】
會通過".$mapno."個傳點。

--------  開始導航  --------
";
            foreach ($path[$destination] as $vertex) {
$sep = "
->";
                $maphop = $maphop."".$vertex."".$sep;
            }
        }
        else {
$maphop = "沒有找到從【".$origin."】
到【".$destination."】的路喔。。";
        }
        $maphop = substr($maphop, 0, -3);
        $maphop = $title."".$maphop;
        error_log("".$maphop."");
  
  
require_once('./LINEBotTiny.php');
$channelAccessToken = getenv('LINE_CHANNEL_ACCESSTOKEN');
$channelSecret = getenv('LINE_CHANNEL_SECRET');
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
    case 'message':
    $client->replyMessage(array(
        'replyToken' => $event['replyToken'],
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $maphop
            )
        )
    ));
}
}
  
  
    }
}
$g = new Graph($graph);
$g->leastHops($code[1], $code[2]);
